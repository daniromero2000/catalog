<?php

namespace Modules\Companies\Entities\EmployeeEpss\Repositories\Interfaces;

use Modules\Companies\Entities\EmployeeEpss\EmployeeEps;

interface EmployeeEpsRepositoryInterface
{
    public function createEmployeeEps(array $data): EmployeeEps;
}
