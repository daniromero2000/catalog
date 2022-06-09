<?php

namespace Modules\Companies\Entities\Employees\Repositories\Interfaces;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Support\Collection;

interface EmployeeRepositoryInterface
{
    public function listEmployees(int $totalView);

    public function createEmployee(array $data): Employee;

    public function findEmployeeById(int $id): Employee;

    public function updateEmployee(array $data): bool;

    public function syncRoles(array $roleIds);

    public function hasRole(string $roleName): bool;

    public function isAuthUser(Employee $employee): bool;

    public function searchEmployee(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countEmployee(string $text = null,  $from = null, $to = null);

    public function deleteEmployee(): bool;

    public function getAllEmployeesNames(): Collection;

    public function getAllEmployeesByPosition($employeePosition);

    public function getAllEmployeesModel();

    public function getEmployeeUserGuard();

    public function findSubsidiaryCammodels(int $subsidiaryId);

    public function getAllManagersIds();
}
