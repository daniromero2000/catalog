<?php

namespace Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces;

use Modules\Companies\Entities\EmployeeStatusesLogs\EmployeeStatusesLog;

interface EmployeeStatusesLogRepositoryInterface
{
    public function createEmployeeStatusesLog(array $data): EmployeeStatusesLog;
}
