<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeesProfiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Companies\Entities\Employees\Requests\CreateEmployeeRequest;
use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Companies\Entities\Employees\Requests\UpdateEmployeeProfileRequest;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeesProfilesController extends Controller
{
    private $employeeInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:employees_profiles, guard:employee']);
        $this->employeeInterface            = $employeeRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
    }

    public function index(Request $request)
    {
        return view('companies::admin.employees.profile', [
            'employee' => auth()->guard('employee')->user()
        ]);
    }

    public function create()
    {
    }

    public function store(CreateEmployeeRequest $request)
    {
    }

    public function show(int $id)
    {
        return view('companies::admin.employees.profile', [
            'employee' => auth()->guard('employee')->user()
        ]);
    }

    public function edit(int $id)
    {
        return redirect()->route('admin.employees.index');
    }

    public function update(UpdateEmployeeProfileRequest $request, $id)
    {
        $update = new EmployeeRepository($this->employeeInterface->findEmployeeById($id));
        $update->updateEmployee($request->except('_token', '_method', 'password'));

        if ($request->has('password') && $request->input('password') != '') {
            $update->updateEmployee($request->only('password'));
        }

        return redirect()->route('admin.employees-profiles.index')->with('message', 'Actualización Exitosa!');
    }

    public function destroy(int $id)
    {
    }

    public function getProfile($id)
    {
        return view('companies::admin.employees.profile', [
            'employee' => auth()->guard('employee')->user()
        ]);
    }
}
