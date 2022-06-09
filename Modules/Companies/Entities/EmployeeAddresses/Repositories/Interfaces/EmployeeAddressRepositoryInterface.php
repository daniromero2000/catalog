<?php

namespace Modules\Companies\Entities\EmployeeAddresses\Repositories\Interfaces;

use Modules\Companies\Entities\EmployeeAddresses\EmployeeAddress;

interface EmployeeAddressRepositoryInterface
{
    public function createEmployeeAddress(array $data): EmployeeAddress;
}
