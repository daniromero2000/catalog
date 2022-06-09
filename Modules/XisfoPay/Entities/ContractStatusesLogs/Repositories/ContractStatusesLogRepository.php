<?php

namespace Modules\XisfoPay\Entities\ContractStatusesLogs\Repositories;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Modules\XisfoPay\Entities\ContractStatusesLogs\ContractStatusesLog;
use Modules\XisfoPay\Entities\ContractStatusesLogs\Repositories\Interfaces\ContractStatusesLogRepositoryInterface;

class ContractStatusesLogRepository implements ContractStatusesLogRepositoryInterface
{
    protected $model;

    public function __construct(ContractStatusesLog $contractCommentary)
    {
        $this->model = $contractCommentary;
    }

    public function createContractStatusesLog(array $data): ContractStatusesLog
    {
        $contractStatusesLog              = new ContractStatusesLog($data);
        $contractCreatedAt                = $contractStatusesLog->contract->created_at;
        $contractStatusesLog->time_passed = $this->contractStatusDaysPassed($contractCreatedAt);
        $contractStatusesLog->save();

        return $contractStatusesLog;
    }

    private function contractStatusDaysPassed($contractCreatedAt)
    {
        return CarbonInterval::seconds($contractCreatedAt->diffInSeconds(Carbon::now()))
            ->cascade()->forHumans();
    }
}
