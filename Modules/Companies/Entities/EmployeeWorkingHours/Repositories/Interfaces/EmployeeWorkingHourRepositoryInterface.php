<?php

namespace Modules\Companies\Entities\EmployeeWorkingHours\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Companies\Entities\EmployeeWorkingHours\EmployeeWorkingHour;

interface EmployeeWorkingHourRepositoryInterface
{
    public function createEmployeeWorkingHour(array $data): EmployeeWorkingHour;

    public function updateEmployeeWorkingHour(array $data): bool;

    public function findEmployeeWorkingHourById(int $id): EmployeeWorkingHour;

    public function listEmployeeWorkingHours($totalView): Collection;

    public function deleteEmployeeWorkingHour(): bool;

    public function searchEmployeeWorkingHour(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countEmployeeWorkingHour(string $text = null,  $from = null, $to = null);

    public function getEmployee($employee_id): Collection;
}
