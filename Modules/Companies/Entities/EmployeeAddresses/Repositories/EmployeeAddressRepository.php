<?php

namespace Modules\Companies\Entities\EmployeeAddresses\Repositories;

use Modules\Companies\Entities\EmployeeAddresses\EmployeeAddress;
use Modules\Companies\Entities\EmployeeAddresses\Repositories\Interfaces\EmployeeAddressRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Companies\Entities\EmployeeAddresses\Exceptions\CreateEmployeeAddressErrorException;

class EmployeeAddressRepository implements EmployeeAddressRepositoryInterface
{
    protected $model;

    public function __construct(EmployeeAddress $employeeAddress)
    {
        $this->model = $employeeAddress;
    }

    public function createEmployeeAddress(array $data): EmployeeAddress
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeAddressErrorException($e->getMessage());
        }
    }
}
