<?php

namespace Modules\Customers\Entities\LeadStatusesLogs\Repositories\Interfaces;

use Modules\Customers\Entities\LeadStatusesLogs\LeadStatusesLog;

interface LeadStatusesLogRepositoryInterface
{
    public function createLeadStatusesLog(array $attributes): LeadStatusesLog;
}
