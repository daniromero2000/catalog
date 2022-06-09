<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeProfessions;

use Modules\Companies\Entities\EmployeeProfessions\Repositories\Interfaces\EmployeeProfessionRepositoryInterface;
use Modules\Companies\Entities\EmployeeProfessions\Requests\CreateEmployeeProfessionRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeeProfessionController extends Controller
{
    private $customerProfessionInterface, $customerStatusesLogInterface;

    public function __construct(
        EmployeeProfessionRepositoryInterface $employeeProfessionRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->customerProfessionInterface = $employeeProfessionRepositoryInterface;
        $this->customerStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
    }

    public function store(CreateEmployeeProfessionRequest $request)
    {
        $profession =  $this->customerProfessionInterface->createEmployeeProfession($request->except('_token', '_method'));
        $user  = ToolRepository::setStaticSignedUser();

        $data = array(
            'employee_id' => $profession->employee->id,
            'status'      => 'Profesión Agregada',
            'user'        => $user->name . ' ' . $user->last_name
        );

        $this->customerStatusesLogInterface->createEmployeeStatusesLog($data);
        return back()->with('message', 'Adición de Profesión Exitosa');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
