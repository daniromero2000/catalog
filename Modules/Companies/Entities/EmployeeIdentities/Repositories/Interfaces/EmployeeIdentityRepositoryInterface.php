<?php

namespace Modules\Companies\Entities\EmployeeIdentities\Repositories\Interfaces;

use Modules\Companies\Entities\EmployeeIdentities\EmployeeIdentity;

interface EmployeeIdentityRepositoryInterface
{
    public function createEmployeeIdentity(array $data): EmployeeIdentity;

    public function checkIfExists($data);
}
