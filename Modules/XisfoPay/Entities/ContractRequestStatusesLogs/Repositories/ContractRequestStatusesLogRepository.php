<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Repositories;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\ContractRequestStatusesLog;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Repositories\Interfaces\ContractRequestStatusesLogRepositoryInterface;

class ContractRequestStatusesLogRepository implements ContractRequestStatusesLogRepositoryInterface
{
    protected $model;

    public function __construct(ContractRequestStatusesLog $contractCommentary)
    {
        $this->model = $contractCommentary;
    }

    public function createContractRequestStatusesLog(array $data): ContractRequestStatusesLog
    {
        $contractRequestStatusesLog              = new ContractRequestStatusesLog($data);
        $contractCreatedAt                       = $contractRequestStatusesLog->contractRequest->created_at;
        $contractRequestStatusesLog->time_passed = $this->contractRequestStatusDaysPassed($contractCreatedAt);
        $contractRequestStatusesLog->save();

        return $contractRequestStatusesLog;
    }

    private function contractRequestStatusDaysPassed($contractCreatedAt)
    {
        return CarbonInterval::seconds($contractCreatedAt->diffInSeconds(Carbon::now()))
            ->cascade()->forHumans();
    }
}
