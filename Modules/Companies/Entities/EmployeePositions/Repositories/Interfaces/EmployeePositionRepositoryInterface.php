<?php

namespace Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface EmployeePositionRepositoryInterface
{
    public function getAllEmployeePositionNames(): Collection;
}
