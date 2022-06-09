<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatusesLogs\UseCases\Interfaces;

interface ContractRequestStatusesLogUseCaseInterface
{
    public function storeContractRequestStatusesLog($id, $status);

    public function storeCustomerContractRequestStatusesLog($id, $status, $customer);
}
