<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeEpss;

use Modules\Companies\Entities\EmployeeEpss\Repositories\Interfaces\EmployeeEpsRepositoryInterface;
use Modules\Companies\Entities\EmployeeEpss\Requests\CreateEmployeeEpsRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeeEpsController extends Controller
{
    private $employeeEpsInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeEpsRepositoryInterface $employeeEpsRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->employeeEpsInterface = $employeeEpsRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
    }

    public function store(CreateEmployeeEpsRequest $request)
    {
        $eps  = $this->employeeEpsInterface->createEmployeeEps($request->except('_token', '_method'));
        $user = ToolRepository::setStaticSignedUser();

        $data = array(
            'employee_id' => $eps->employee->id,
            'status'      => 'Eps Agregada',
            'user'        => $user->name . ' ' . $user->last_name
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);
        return back()->with('message', 'Adición de Teléfono Exitosa');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
