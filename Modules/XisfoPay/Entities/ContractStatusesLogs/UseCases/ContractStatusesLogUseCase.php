<?php

namespace Modules\XisfoPay\Entities\ContractStatusesLogs\UseCases;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatusesLogs\Repositories\Interfaces\ContractStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatusesLogs\UseCases\Interfaces\ContractStatusesLogUseCaseInterface;

class ContractStatusesLogUseCase implements ContractStatusesLogUseCaseInterface
{
    private $contractStatusesLogInterface, $toolsInterface;

    public function __construct(
        ContractStatusesLogRepositoryInterface $contractStatusesLogRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->contractStatusesLogInterface = $contractStatusesLogRepositoryInterface;
        $this->toolsInterface               = $toolRepositoryInterface;
    }

    public function storeContractStatusesLog($id, $status)
    {
        $user = $this->toolsInterface->setSignedUser();
        $data = array(
            'contract_id' => $id,
            'status'      => $status,
            'user'        => $user->name . ' ' . $user->last_name
        );

        $this->contractStatusesLogInterface->createContractStatusesLog($data);
    }
}
