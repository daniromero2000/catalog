<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeEmergencyContacts;

use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeEmergencyContacts\Repositories\Interfaces\EmployeeEmergencyContactRepositoryInterface;
use Modules\Companies\Entities\EmployeeEmergencyContacts\Requests\CreateEmployeeEmergencyContactRequest;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeeEmergencyContactController extends Controller
{
    private $employeeEmergencyContactInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeEmergencyContactRepositoryInterface $employeeEmergencyContactRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->employeeEmergencyContactInterface = $employeeEmergencyContactRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
    }

    public function store(CreateEmployeeEmergencyContactRequest $request)
    {
        $emergencycontact = $this->employeeEmergencyContactInterface
            ->createEmployeeEmergencyContact($request->except('_token', '_method'));
        $user  =   ToolRepository::setStaticSignedUser();

        $data = [
            'employee_id' => $emergencycontact->employee->id,
            'status'      => 'Contacto de Emergencia Agregado',
            'user'        => $user->name . ' ' . $user->last_name
        ];

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);
        return back()->with('message', 'Adición de Contacto de Emergencia Exitosa!');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
