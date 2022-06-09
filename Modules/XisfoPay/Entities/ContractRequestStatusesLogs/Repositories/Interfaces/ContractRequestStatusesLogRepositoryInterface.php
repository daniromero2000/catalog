<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Repositories\Interfaces;

use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\ContractRequestStatusesLog;

interface ContractRequestStatusesLogRepositoryInterface
{
    public function createContractRequestStatusesLog(array $data): ContractRequestStatusesLog;
}
