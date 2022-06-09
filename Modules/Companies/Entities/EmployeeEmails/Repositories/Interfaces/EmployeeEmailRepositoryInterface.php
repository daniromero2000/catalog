<?php

namespace Modules\Companies\Entities\EmployeeEmails\Repositories\Interfaces;

use Modules\Companies\Entities\EmployeeEmails\EmployeeEmail;

interface EmployeeEmailRepositoryInterface
{
    public function createEmployeeEmail(array $data): EmployeeEmail;
}
