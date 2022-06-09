<?php

namespace Modules\Companies\Entities\EmployeePositions\Repositories;

use Illuminate\Support\Collection;
use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;

class EmployeePositionRepository implements EmployeePositionRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'position'];

    public function __construct(
        EmployeePosition $employeePosition
    ) {
        $this->model = $employeePosition;
    }

    public function getAllEmployeePositionNames(): Collection
    {
        return $this->model->orderBy('position', 'asc')->get($this->columns);
    }
}
