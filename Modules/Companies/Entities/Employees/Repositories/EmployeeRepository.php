<?php

namespace Modules\Companies\Entities\Employees\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Employees\Exceptions\CreateEmployeeErrorException;
use Modules\Companies\Entities\Employees\Exceptions\EmployeeNotFoundException;
use Modules\Companies\Entities\Employees\Exceptions\UpdateEmployeeErrorException;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'last_name',
        'email',
        'rh',
        'bank_account',
        'admission_date',
        'subsidiary_id',
        'employee_position_id',
        'is_active',
        'customer_id',
        'birthday',
        'shift_id',
        'password'
    ];

    private $employeeColumns = [
        'id',
        'name',
        'last_name',
        'email',
        'rh',
        'bank_account',
        'admission_date',
        'subsidiary_id',
        'employee_position_id',
        'is_active',
        'last_login_at',
        'is_rotative',
        'birthday',
        'customer_id',
        'shift_id',
        'password',
        'avatar'
    ];

    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    public function listEmployees(int $totalView)
    {
        return  $this->model->with(['employeePosition', 'role'])
            ->orderBy('name', 'asc')
            ->skip($totalView)->take(10)
            ->get($this->employeeColumns);
    }

    public function createEmployee(array $data): Employee
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeErrorException($e->getMessage());
        }
    }

    public function findEmployeeById(int $id): Employee
    {
        try {
            return $this->model->with([
                'employeeCommentaries',
                'subsidiary',
                'employeeStatusesLogs',
                'employeePosition',
                'employeeEmails',
                'employeePhones',
                'employeeAddresses',
                'employeeEmergencyContact',
                'employeeIdentities',
                'employeeEpss',
                'employeeProfessions',
                'role'
            ])->findOrFail($id, $this->employeeColumns);
        } catch (ModelNotFoundException $e) {
            throw new EmployeeNotFoundException($e->getMessage());
        }
    }

    public function updateEmployee(array $data): bool
    {
        try {
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateEmployeeErrorException($e->getMessage());
        }
    }

    public function syncRoles(array $roleIds)
    {
        try {
            $this->model->roles()->sync($roleIds);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function hasRole(string $roleName): bool
    {
        return $this->model->hasRole($roleName);
    }

    public function isAuthUser(Employee $employee): bool
    {
        $isAuthUser = false;
        if (Auth::guard('employee')->user()->id == $employee->id) {
            $isAuthUser = true;
        }

        return $isAuthUser;
    }

    public function deleteEmployee(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getAllEmployeesNames(): Collection
    {
        return $this->model->where('is_active', 1)->orderBy('name', 'desc')
            ->get(['id', 'name', 'last_name']);
    }

    public function searchEmployee(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listEmployees($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchEmployee($text)
                ->skip($totalView)
                ->take(10)
                ->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)
                ->take(10)
                ->get($this->columns);
        }

        return $this->model->searchEmployee($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->skip($totalView)
            ->take(10)
            ->get($this->columns);
    }

    public function countEmployee(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchEmployee($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchEmployee($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function saveEmployeeSignature(UploadedFile $file, $employee): string
    {
        return $file->store('employees/' . $employee, ['disk' => 'public']);
    }

    public function saveEmployeeAvatar(UploadedFile $file, $employee): string
    {
        return $file->store('employees/' . $employee, ['disk' => 'public']);
    }

    public function getAllEmployeesByPosition($employeePosition)
    {
        return $this->model
            ->where('employee_position_id', $employeePosition)
            ->get(['id', 'name', 'last_name']);
    }

    public function getAllEmployeesModel()
    {
        return $this->model
            ->where('employee_position_id', '8')
            ->with('cammodel')
            ->doesntHave('cammodel')
            ->get(['id', 'name', 'last_name']);
    }

    public function getEmployeeUserGuard()
    {
        return auth()->guard('employee')->user();
    }

    public function findSubsidiaryCammodels(int $subsidiaryId)
    {
        return $this->model
            ->with('cammodelId')
            ->where('employee_position_id', '8')
            ->where('subsidiary_id', $subsidiaryId)
            ->get(['id', 'name']);
    }

    public function getAllManagersIds()
    {
        return $this->model
            ->where('is_active', 1)
            ->where('employee_position_id', '7')
            ->get('id');
    }
}
