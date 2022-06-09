<?php

namespace Modules\XisfoPay\Entities\ContractStatusesLogs\UseCases\Interfaces;

interface ContractStatusesLogUseCaseInterface
{
    public function storeContractStatusesLog($id, $status);
}
