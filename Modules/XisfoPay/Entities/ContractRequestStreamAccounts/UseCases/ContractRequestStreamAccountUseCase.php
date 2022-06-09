<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccounts\UseCases;

use Illuminate\Support\Facades\Mail;
use Modules\XisfoPay\Mail\PaymentDatesNotifications\SendNewPaymentDatesNotificationEmailCustomer;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Exceptions\ContractRequestStreamAccountCommissionNotFoundException;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\Interfaces\ContractRequestStreamAccountCommissionRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Exceptions\ContractRequestStreamAccountNotFoundException;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Exceptions\CreateContractRequestStreamAccountErrorException;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\ContractRequestStreamAccountRepository;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\UseCases\Interfaces\ContractRequestStreamAccountUseCaseInterface;

class ContractRequestStreamAccountUseCase implements ContractRequestStreamAccountUseCaseInterface
{
    private $contractRequestStreamAccountInterface, $toolsInterface;
    private $contractRequestStreamAccountCommissionInterface;

    public function __construct(
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountRepositoryInterface,
        ContractRequestStreamAccountCommissionRepositoryInterface $contractRequestStreamAccountCommissionRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        StreamingRepositoryInterface $streamingRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->contractRequestStreamAccountInterface           = $contractRequestStreamAccountRepositoryInterface;
        $this->contractRequestStreamAccountCommissionInterface = $contractRequestStreamAccountCommissionRepositoryInterface;
        $this->contractRequestsInterface                       = $contractRequestRepositoryInterface;
        $this->streamingInterface                              = $streamingRepositoryInterface;
        $this->toolsInterface                                  = $toolRepositoryInterface;
        $this->module                                          = 'Plataformas Cliente';
    }

    public function listContractRequestStreamAccount(array $requestData)
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($requestData);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];
        $user            = $this->toolsInterface->setSignedUser();

        if ($user->hasRole('xisfopay_comercial')) {
            $list = $this->contractRequestStreamAccountInterface->searchContractRequestStreamAccount($searchData['q'], $user->id);
        } else {
            $list = $this->contractRequestStreamAccountInterface->searchContractRequestStreamAccount($searchData['q']);
        }

        return [
            'data' => [
                'contractRequestStreamAccounts'       => $list,
                'contract_request_id'                 => $this->contractRequestsInterface->getAllContractRequestNames(),
                'streamings'                          => $this->streamingInterface->getAllStreamingNames(),
                'optionsRoutes'                       => config('generals.optionRoutes'),
                'module'                              => $this->module,
                'headers'                             => ['Customer', 'Cuenta', 'Comisión', 'Activo / Configurado', 'Opciones'],
                'streamAccountCommissions'            => $this->contractRequestStreamAccountCommissionInterface->getAllStreamAccountCommissions()
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createContractRequestStreamAccount()
    {
        return [
            'data' => [
                'optionsRoutes'       => config('generals.optionRoutes'),
                'module'              => $this->module,
                'contract_request_id' => $this->contractRequestsInterface->getAllContractRequestNames(),
                'streamings'          => $this->streamingInterface->getAllStreamingNames()
            ]
        ];
    }

    public function storeContractRequestStreamAccount($request)
    {
        $streamAccountCommission = $this->contractRequestStreamAccountCommissionInterface->findCommissionByStreaming($request['streaming_id']);
        $request['contract_request_stream_account_commission_id'] = $streamAccountCommission->id;
        $this->contractRequestStreamAccountInterface->createContractRequestStreamAccount($request->except('_token', '_method'));
    }

    public function updateContractRequestStreamAccount($request, int $id)
    {
        $update = new ContractRequestStreamAccountRepository($this->contractRequestStreamAccountInterface->findContractRequestStreamAccountById($id));
        $update->updateContractRequestStreamAccount($request->except('_token', '_method'));
    }

    public function deleteContractRequestStreamAccount(int $id)
    {
        $contractRequestStreamAccount = $this->contractRequestStreamAccountInterface->findContractRequestStreamAccountById($id);
        $contractRequestStreamAccountRepo = new ContractRequestStreamAccountRepository($contractRequestStreamAccount);
        $contractRequestStreamAccountRepo->deleteContractRequestStreamAccount();
    }

    public function sendPaymentDatesNotifications(array $streamingsIds)
    {
        foreach ($streamingsIds as $streamingId) {
            $streamAccounts = $this->contractRequestStreamAccountInterface->findStreamingContractRequests($streamingId);
            foreach ($streamAccounts as $streamAccount) {
                $this->sendPaymentDatesNotificationEmail($streamAccount->contractRequest, $streamAccount->streaming->streaming);
            }
        }
    }

    private function sendPaymentDatesNotificationEmail($streamAccountEmail, $streamingName)
    {
        Mail::to(['email' => $streamAccountEmail])
            ->send(new SendNewPaymentDatesNotificationEmailCustomer($streamingName));
    }
}
