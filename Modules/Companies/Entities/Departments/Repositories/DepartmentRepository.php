<?php

namespace Modules\Companies\Entities\Departments\Repositories;

use Illuminate\Support\Collection;
use Modules\Companies\Entities\Departments\Department;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name'];

    public function __construct(Department $department)
    {
        $this->model = $department;
    }

    public function getAllDepartmentNames(): Collection
    {
        return $this->model->orderBy('name', 'desc')->get($this->columns);
    }
}
