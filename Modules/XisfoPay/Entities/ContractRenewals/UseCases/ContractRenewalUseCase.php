<?php

namespace Modules\XisfoPay\Entities\ContractRenewals\UseCases;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Modules\XisfoPay\Entities\ContractRenewals\Exceptions\ContractRenewalNotFoundException;
use Modules\XisfoPay\Entities\ContractRenewals\Exceptions\DeletingContractRenewalErrorException;
use Modules\XisfoPay\Entities\ContractRenewals\Repositories\ContractRenewalRepository;
use Modules\XisfoPay\Entities\ContractRenewals\Repositories\Interfaces\ContractRenewalRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces\ContractRenewalUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRates\Repositories\Interfaces\ContractRateRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\Contracts\Repositories\Interfaces\ContractRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatusesLogs\UseCases\Interfaces\ContractStatusesLogUseCaseInterface;
use Modules\XisfoPay\Events\ContractRenewals\ContractRenewalWasCreated;
use Modules\XisfoPay\Mail\ContractRenewals\SendExpiredRenewalsEmailNotificationToAdmin;
use Modules\XisfoPay\Mail\ContractRenewals\SendUnapprobedRenewalsEmailNotificationToAdmin;

class ContractRenewalUseCase implements ContractRenewalUseCaseInterface
{
    private $contractRenewalInterface, $toolsInterface, $module;
    private $contractRateInterface, $contractInterface, $contractStatusesLogServiceInterface;
    private $contractRequestStreamAccountInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractRenewalRepositoryInterface $cammodelFineRepositoryInterface,
        ContractRateRepositoryInterface $contractRateRepositoryInterface,
        ContractRepositoryInterface $contractRepositoryInterface,
        ContractStatusesLogUseCaseInterface $contractStatusesLogUseCaseInterface,
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountRepositoryInterface
    ) {
        $this->toolsInterface                        = $toolRepositoryInterface;
        $this->contractRenewalInterface              = $cammodelFineRepositoryInterface;
        $this->contractRateInterface                 = $contractRateRepositoryInterface;
        $this->contractInterface                     = $contractRepositoryInterface;
        $this->contractStatusesLogServiceInterface   = $contractStatusesLogUseCaseInterface;
        $this->contractRequestStreamAccountInterface = $contractRequestStreamAccountRepositoryInterface;
        $this->module                                = 'Renovaciones de Contrato';
    }

    public function listContractRenewals(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'contractRenewals' => $this->contractRenewalInterface->searchContractRenewal($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']),
                'optionsRoutes'    => config('generals.optionRoutes'),
                'module'           => $this->module,
                'headers'          => ['ACTIVO', 'FECHA', 'Identificador', 'CLIENTE', 'INICIO', 'EXPIRACIÓN', 'TARIFA', 'TARIFA ESPECIAL / APROBADO'],
                'contract_rates'   => $this->contractRateInterface->getAllContractRates()
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function storeContractRenewal(array $requestData)
    {
        $contractRenewal = $this->contractRenewalInterface->createContractRenewal($requestData);
        $contractRenewal->load(['contract']);
        $contractRenewal->is_aprobed = 1;
        $contractRenewal->contract_rate_id = $contractRenewal->contract->contractRequests[0]->contract_request_type == 3 ? 3 : 1;
        $contractRenewal->save();
        $this->contractStatusesLogServiceInterface->storeContractStatusesLog($contractRenewal->contract_id, 'Contrato Renovado/En Vigencia');
        event(new ContractRenewalWasCreated($contractRenewal));
    }

    public function updateContractRenewal($request, int $id)
    {
        $contractRenewal = $this->getContractRenewal($id);
        $status = 'Renovación Actualizada';

        if ($request['is_aprobed'] == 1) {
            $this->contractInterface->activateContract($contractRenewal->contract);
            $this->contractRequestStreamAccountInterface->activateStreamingAccounts($contractRenewal->contract->contractRequests[0]->contractRequestStreamAccount);
            $status = 'Renovación Aprobada';
        }

        $requestData = $request->except(
            '_token',
            '_method',
        );

        $update = new ContractRenewalRepository($contractRenewal);
        if ($request->hasFile('file')) {
            if ($contractRenewal->file) {
                $this->toolsInterface->deleteThumbFromServer($contractRenewal->file);
            }
            $requestData['file'] = $this->saveAccountCertificate($request->file('file'), $contractRenewal->contract->contractRequests[0]->client_identifier);
            $status = 'Se adjunta Archivo';
        }

        $update->updateContractRenewal($requestData);
        $contractRenewal = $contractRenewal->fresh();
        if ($contractRenewal->contractRate->type == 1) {
            $contractRenewal->is_special_price = 1;
            $contractRenewal->save();
        }
        $this->contractStatusesLogServiceInterface->storeContractStatusesLog($contractRenewal->contract_id, $status);
    }

    private function getContractRenewal(int $id)
    {
        return $this->contractRenewalInterface->findContractRenewalById($id);
    }

    public function saveAccountCertificate(UploadedFile $file, $client): string
    {
        return $file->store('contract-renewals/' . $client, ['disk' => 'public']);
    }

    public function checkIfUnapprobedRenewals()
    {
        $unApprobedRenewals = $this->contractRenewalInterface->findUnapprobedContractRenewals();

        if (!$unApprobedRenewals->isEmpty()) {
            $this->sendUnapprobedRenewalsEmailNotificationToAdmin($unApprobedRenewals);
        }
    }

    private function sendUnapprobedRenewalsEmailNotificationToAdmin($data)
    {
        Mail::to(['email' => 'aux.mercadeo.xisfo@gmail.com'])->cc([
            'carlosq.syc@gmail.com',
            'financiero0.syc@gmail.com'
        ])->queue(new SendUnapprobedRenewalsEmailNotificationToAdmin($data));
    }

    public function checkIfExpiredRenewals()
    {
        $expiredRenewals = $this->contractRenewalInterface->findExpiredContractRenewals();

        if (!$expiredRenewals->isEmpty()) {
            $expiredRenewals->each(function ($renewal) {
                $renewal->is_active                    = 0;
                $renewal->contract->contract_status_id = 5;
                $renewal->contract->is_active          = 0;
                $renewal->contract->is_aprobed         = 0;
                $renewal->save();
                $renewal->contract->save();
                $this->deactivateStreamAccounts($renewal);
            });

            $this->sendExpiredRenewalsEmailNotificationToAdmin($expiredRenewals);
        }
    }

    public function deactivateStreamAccounts($renewal)
    {
        $renewal->contract->contractRequests[0]->contractRequestStreamAccount->each(function ($stream) {
            $stream->is_active = 0;
            $stream->save();
        });
    }

    public function sendExpiredRenewalsEmailNotificationToAdmin($data)
    {
        Mail::to(['email' => 'aux.mercadeo.xisfo@gmail.com'])->cc([
            'carlosq.syc@gmail.com',
            'financiero0.syc@gmail.com'
        ])->queue(new SendExpiredRenewalsEmailNotificationToAdmin($data));
    }

    public function destroyContractRenewal(int $id)
    {
        try {
            $contractRenewal = $this->getContractRenewal($id);
        } catch (ContractRenewalNotFoundException $e) {
            throw new DeletingContractRenewalErrorException($e->getMessage());
        }

        $contractRenewalRepo = new ContractRenewalRepository($contractRenewal);
        $contractRenewalRepo->deleteContractRenewal();
    }

    public function setRenewalDates(int $id)
    {
        $contractRenewal = $this->getContractRenewal($id);
        $contractRenewal->starts  = Carbon::now()->format('Y-m-d');
        $contractRenewal->expires = Carbon::now()->addYear()->format('Y-m-d');
        $contractRenewal->save();
    }
}
