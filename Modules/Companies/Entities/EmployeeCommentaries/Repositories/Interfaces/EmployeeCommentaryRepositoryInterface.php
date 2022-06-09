<?php

namespace Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface EmployeeCommentaryRepositoryInterface
{
    public function listEmployeeCommentaries(int $employeeId): Collection;

    public function createEmployeeCommentary(array $data);
}
