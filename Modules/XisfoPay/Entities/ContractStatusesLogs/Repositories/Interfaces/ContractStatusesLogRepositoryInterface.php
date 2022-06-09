<?php

namespace Modules\XisfoPay\Entities\ContractStatusesLogs\Repositories\Interfaces;

use Modules\XisfoPay\Entities\ContractStatusesLogs\ContractStatusesLog;

interface ContractStatusesLogRepositoryInterface
{
    public function createContractStatusesLog(array $data): ContractStatusesLog;
}
