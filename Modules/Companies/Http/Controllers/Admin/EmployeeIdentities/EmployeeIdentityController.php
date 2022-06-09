<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeIdentities;

use Modules\Companies\Entities\EmployeeIdentities\Repositories\Interfaces\EmployeeIdentityRepositoryInterface;
use Modules\Companies\Entities\EmployeeIdentities\Requests\CreateEmployeeIdentityRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeeIdentityController extends Controller
{
    private $employeeIdentityInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeIdentityRepositoryInterface $employeeIdentityRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->employeeIdentityInterface    = $employeeIdentityRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
    }

    public function store(CreateEmployeeIdentityRequest $request)
    {
        $identity = $this->employeeIdentityInterface->createEmployeeIdentity($request->except('_token', '_method'));
        $user     = ToolRepository::setStaticSignedUser();

        $data = array(
            'employee_id' => $identity->employee->id,
            'status'      => 'Identidad Agregada',
            'user'        => $user->name . ' ' . $user->last_name
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);
        return back()->with('message', 'Adición de Identidad Exitosa');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
