<?php

namespace Modules\Companies\Entities\EmployeePhones\Repositories\Interfaces;

use Modules\Companies\Entities\EmployeePhones\EmployeePhone;

interface EmployeePhoneRepositoryInterface
{
    public function createEmployeePhone(array $data): EmployeePhone;

    public function checkIfExists($data);
}
