<?php

namespace Modules\XisfoPay\Entities\Contracts\UseCases;

use Carbon\Carbon;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRates\Repositories\Interfaces\ContractRateRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces\ContractRenewalUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\UseCases\Interfaces\ContractRequestStatusesLogUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\Contracts\Repositories\ContractRepository;
use Modules\XisfoPay\Entities\Contracts\Repositories\Interfaces\ContractRepositoryInterface;
use Modules\XisfoPay\Entities\Contracts\UseCases\Interfaces\ContractUseCaseInterface;
use Modules\XisfoPay\Entities\ContractStatuses\Repositories\Interfaces\ContractStatusRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatusesLogs\UseCases\Interfaces\ContractStatusesLogUseCaseInterface;

class ContractUseCase implements ContractUseCaseInterface
{
    private $toolsInterface, $contractInterface, $contractRenewalServiceInterface;
    private $contractStatusesLogServiceInterface, $contractRequestInterface;
    private $contractRequestStatusesLogServiceInterface, $contractRequestStreamAccountInterface;
    private $contractStatusesInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractRepositoryInterface $contractRepositoryInterface,
        ContractStatusRepositoryInterface $contractStatusRepositoryInterface,
        ContractStatusesLogUseCaseInterface $contractStatusesLoguseCaseInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        ContractRateRepositoryInterface $contractRateRepositoryInterface,
        ContractRequestStatusesLogUseCaseInterface $contractRequestStatusesLogUseCaseInterface,
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountRepositoryInterface,
        ContractRenewalUseCaseInterface $contractRenewalUseCaseInterface
    ) {
        $this->toolsInterface                             = $toolRepositoryInterface;
        $this->contractInterface                          = $contractRepositoryInterface;
        $this->contractStatusesInterface                  = $contractStatusRepositoryInterface;
        $this->contractStatusesLogServiceInterface        = $contractStatusesLoguseCaseInterface;
        $this->contractRequestInterface                   = $contractRequestRepositoryInterface;
        $this->contractRateInterface                      = $contractRateRepositoryInterface;
        $this->contractRequestStatusesLogServiceInterface = $contractRequestStatusesLogUseCaseInterface;
        $this->contractRequestStreamAccountInterface      = $contractRequestStreamAccountRepositoryInterface;
        $this->contractRenewalServiceInterface            = $contractRenewalUseCaseInterface;
        $this->module                                     = 'Contratos';
    }

    public function listContracts(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'contracts'         => $this->contractInterface->searchContract($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']),
                'contract_statuses' => $this->contractStatusesInterface->getAllContractStatusesNames(),
                'contracts_total'   => 10,
                'optionsRoutes'     => config('generals.optionRoutes'),
                'module'            => $this->module,
                'headers'           => ['Activo', 'Fecha', 'Cliente', 'Identificador',  'Estado', 'Firmado / Aprobado', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function listCustomerContracts(array $data): array
    {
        $contracts_ids   = $this->contractRequestInterface->getCustomerContracts(auth()->user()->id);
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'contracts'         => $this->contractInterface->searchContractsByCustomerId($searchData['q'], $contracts_ids),
                'contract_statuses' => $this->contractStatusesInterface->getAllContractStatusesNames(),
                'module'            => $this->module,
                'optionsRoutes'     => config('generals.optionRoutes'),
                'headers'           => ['Activo', 'Fecha', 'Cliente', 'Identificador',  'Estado', 'Firmado / Aprobado', 'Opciones'],
            ],
            'search' => $searchData['search']
        ];
    }

    public function storeContract($request)
    {
        $contract = $this->contractInterface->createContract($request->except('_token', '_method'));
        $contract = $this->updateContracRequest($request->input(), $contract);

        $renewalData = [
            'contract_id'      => $contract->id,
            'starts'           => Carbon::now()->format('Y-m-d'),
            'expires'          => Carbon::now()->addYear()->format('Y-m-d')
        ];

        $this->contractRenewalServiceInterface->storeContractRenewal($renewalData);
        $this->contractStatusesLogServiceInterface->storeContractStatusesLog($contract->id, 'Contrato Creado');

        return $contract;
    }

    public function showContract(int $id)
    {
        return  [
            'contract'          => $this->getContract($id),
            'module'            => $this->module,
            'optionsRoutes'     => config('generals.optionRoutes'),
            'contract_statuses' => $this->contractStatusesInterface->getAllContractStatusesNames()
        ];
    }

    public function updateContract($request, int $id)
    {
        $contract = $this->getContract($id);
        $requestData = $this->setContractIsAprobed($contract, $request->input());
        $update      = new ContractRepository($contract);
        $update->updateContract($requestData);
        $this->contractStatusesLogServiceInterface->storeContractStatusesLog($contract->id, $this->contractInterface->setUpdateLogStatus($contract, $request));

        return $contract;
    }

    public function destroyContract(int $id)
    {
        $update = new ContractRepository($this->getContract($id));
        $update->deleteContract();
    }

    private function getContract(int $id)
    {
        return $this->contractInterface->findContractById($id);
    }

    public function updateContracRequest($requestData, $contract)
    {
        if (array_key_exists('contract_request_id', $requestData)) {
            $contract_request              = $this->contractRequestInterface->findContractRequestById($requestData['contract_request_id']);
            $contract_request->contract_id = $contract->id;
            $contract_request->save();
            $this->contractRequestStatusesLogServiceInterface->storeContractRequestStatusesLog($contract_request->id, 'Contrato Creado');
        }

        return $contract->load(['contractRequests']);
    }

    public function setContractIsAprobed($contract, $requestData)
    {
        if ($contract->is_aprobed == 0 && $requestData['contract_status_id'] == 4) {
            $requestData['is_aprobed'] = 1;
            $requestData['is_active']  = 1;
            $this->contractRequestStreamAccountInterface->activateStreamingAccounts($contract->contractRequests[0]->contractRequestStreamAccount);
        }

        return $requestData;
    }

    public function setContractIsSigned($contract, $requestData)
    {
        if ($contract->is_aprobed == 0 && $requestData['contract_status_id'] == 4) {
            $requestData['is_active']  = 1;
            $this->contractRequestStreamAccountInterface->activateStreamingAccounts($contract->contractRequests[0]->contractRequestStreamAccount);
        }

        return $requestData;
    }
}
