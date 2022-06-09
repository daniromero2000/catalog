<?php

namespace Modules\Customers\Entities\CustomerStatusesLogs\Repositories;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Modules\Customers\Entities\CustomerStatusesLogs\CustomerStatusesLog;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerStatusesLogRepository implements CustomerStatusesLogRepositoryInterface
{
    protected $model;

    public function __construct(CustomerStatusesLog $customerStatusesLog)
    {
        $this->model = $customerStatusesLog;
    }

    public function createCustomerStatusesLog(array $attributes): CustomerStatusesLog
    {
        $customerStatusesLog              = new CustomerStatusesLog($attributes);
        $customerCreatedAt                = $customerStatusesLog->customer->created_at;
        $customerStatusesLog->time_passed = $this->customerStatusDaysPassed($customerCreatedAt);
        $customerStatusesLog->save();

        return $customerStatusesLog;
    }

    private function customerStatusDaysPassed($customerCreatedAt)
    {
        return CarbonInterval::seconds($customerCreatedAt->diffInSeconds(Carbon::now()))
            ->cascade()->forHumans();
    }
}
