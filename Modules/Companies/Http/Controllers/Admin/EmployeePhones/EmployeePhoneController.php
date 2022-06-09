<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeePhones;

use Modules\Companies\Entities\EmployeePhones\Repositories\Interfaces\EmployeePhoneRepositoryInterface;
use Modules\Companies\Entities\EmployeePhones\Requests\CreateEmployeePhoneRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeePhoneController extends Controller
{
    private $employeePhoneInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeePhoneRepositoryInterface $employeePhoneRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->employeePhoneInterface       = $employeePhoneRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
    }

    public function store(CreateEmployeePhoneRequest $request)
    {
        $phone = $this->employeePhoneInterface->createEmployeePhone($request->except('_token', '_method'));
        $user  = ToolRepository::setStaticSignedUser();

        $data = array(
            'employee_id' => $phone->employee->id,
            'status'      => 'Teléfono Agregado',
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
