<?php

namespace Modules\Companies\Entities\EmployeeEpss\Repositories;

use Modules\Companies\Entities\EmployeeEpss\EmployeeEps;
use Modules\Companies\Entities\EmployeeEpss\Repositories\Interfaces\EmployeeEpsRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Companies\Entities\EmployeeEpss\Exceptions\CreateEmployeeEpsErrorException;

class EmployeeEpsRepository implements EmployeeEpsRepositoryInterface
{
    protected $model;

    public function __construct(EmployeeEps $employeeEps)
    {
        $this->model = $employeeEps;
    }

    public function createEmployeeEps(array $data): EmployeeEps
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeEpsErrorException($e->getMessage());
        }
    }
}
