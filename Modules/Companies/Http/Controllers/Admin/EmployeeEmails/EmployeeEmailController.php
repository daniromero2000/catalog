<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeEmails;

use Modules\Companies\Entities\EmployeeEmails\Repositories\Interfaces\EmployeeEmailRepositoryInterface;
use Modules\Companies\Entities\EmployeeEmails\Requests\CreateEmployeeEmailRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeeEmailController extends Controller
{
    private $employeeEmailInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeEmailRepositoryInterface $employeeEmailRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->employeeEmailInterface       = $employeeEmailRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
    }

    public function store(CreateEmployeeEmailRequest $request)
    {
        $email = $this->employeeEmailInterface->createEmployeeEmail($request->except('_token', '_method'));
        $user  = ToolRepository::setStaticSignedUser();

        $data = array(
            'employee_id' => $email->employee->id,
            'status'      => 'Email Agregado',
            'user'        => $user->name . ' ' . $user->last_name
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);
        return back()->with('message', 'Adición de Email Exitosa');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
