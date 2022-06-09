<?php

namespace Modules\Customers\Entities\LeadStatusesLogs\Repositories;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\QueryException;
use Modules\Customers\Entities\LeadStatusesLogs\LeadStatusesLog;
use Modules\Customers\Entities\LeadStatusesLogs\Repositories\Interfaces\LeadStatusesLogRepositoryInterface;

class LeadStatusesLogRepository implements LeadStatusesLogRepositoryInterface
{
    public function __construct(LeadStatusesLog $LeadStatusesLog)
    {
        $this->model = $LeadStatusesLog;
    }

    public function createLeadStatusesLog(array $attributes): LeadStatusesLog
    {
        try {
            $leadStatusesLog              = new LeadStatusesLog($attributes);
            $leadCreatedAt                = $leadStatusesLog->lead->created_at;
            $leadStatusesLog->time_passed = $this->LeadStatusDaysPassed($leadCreatedAt);
            $leadStatusesLog->save();

            return $leadStatusesLog;
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    private function LeadStatusDaysPassed($leadCreatedAt)
    {
        return CarbonInterval::seconds($leadCreatedAt->diffInSeconds(Carbon::now()))
            ->cascade()->forHumans();
    }
}
