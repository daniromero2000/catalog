<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatusesLogs\UseCases;

use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Repositories\Interfaces\ContractRequestStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\UseCases\Interfaces\ContractRequestStatusesLogUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class ContractRequestStatusesLogUseCase implements ContractRequestStatusesLogUseCaseInterface
{
    private $contractRequestStatusesLogInterface, $toolsInterface;

    public function __construct(
        ContractRequestStatusesLogRepositoryInterface $contractRequestStatusesLogRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->contractRequestStatusesLogInterface = $contractRequestStatusesLogRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
    }

    public function storeContractRequestStatusesLog($id, $status)
    {
        $user = $this->toolsInterface->setSignedUser();
        $data = array(
            'contract_request_id' => $id,
            'status'              => $status,
            'user'                => $user->name . ' ' . $user->last_name
        );

        $this->contractRequestStatusesLogInterface->createContractRequestStatusesLog($data);
    }

    public function storeCustomerContractRequestStatusesLog($id, $status, $customer)
    {
        $data = array(
            'contract_request_id' => $id,
            'status'              => $status,
            'user'                => $customer->name . ' ' . $customer->last_name
        );

        $this->contractRequestStatusesLogInterface->createContractRequestStatusesLog($data);
    }
}
