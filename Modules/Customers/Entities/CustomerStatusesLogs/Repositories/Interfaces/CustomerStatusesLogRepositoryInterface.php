<?php

namespace Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces;

use Modules\Customers\Entities\CustomerStatusesLogs\CustomerStatusesLog;


interface CustomerStatusesLogRepositoryInterface
{
    public function createCustomerStatusesLog(array $data): CustomerStatusesLog;
}
