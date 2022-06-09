<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeAddresses;

use Modules\Companies\Entities\EmployeeAddresses\Repositories\Interfaces\EmployeeAddressRepositoryInterface;
use Modules\Companies\Entities\EmployeeAddresses\Requests\CreateEmployeeAddressRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeeAddressController extends Controller
{
    private $employeeAddressInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeAddressRepositoryInterface $employeeAddressRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->employeeAddressInterface     = $employeeAddressRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
    }

    public function store(CreateEmployeeAddressRequest $request)
    {
        $address = $this->employeeAddressInterface->createEmployeeAddress($request->except('_token', '_method'));
        $user            = auth()->guard('employee')->user();

        $data = array(
            'employee_id' => $address->employee->id,
            'status'      => 'Dirección Agregada',
            'user'        => $user->name . ' ' . $user->last_name
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Adición de Residencia Exitosa!');
        return back();
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
