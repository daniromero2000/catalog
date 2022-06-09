<?php

namespace Modules\Companies\Entities\EmployeeEmails\Repositories;

use Modules\Companies\Entities\EmployeeEmails\EmployeeEmail;
use Modules\Companies\Entities\EmployeeEmails\Repositories\Interfaces\EmployeeEmailRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Companies\Entities\EmployeeEmails\Exceptions\CreateEmployeeEmailErrorException;

class EmployeeEmailRepository implements EmployeeEmailRepositoryInterface
{
    protected $model;
    public function __construct(EmployeeEmail $employeeEmail)
    {
        $this->model = $employeeEmail;
    }

    public function createEmployeeEmail(array $data): EmployeeEmail
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeEmailErrorException($e->getMessage());
        }
    }
}
