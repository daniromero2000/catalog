<?php

namespace Modules\Companies\Entities\Departments\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface DepartmentRepositoryInterface
{
    public function getAllDepartmentNames(): Collection;
}
