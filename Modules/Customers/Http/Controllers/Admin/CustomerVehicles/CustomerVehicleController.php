<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerVehicles;

use Modules\Customers\Entities\CustomerVehicles\Repositories\Interfaces\CustomerVehicleRepositoryInterface;
use Modules\Customers\Entities\CustomerVehicles\Requests\CreateCustomerVehicleRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerVehicleController extends Controller
{
    private $customerVehicleInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerVehicleRepositoryInterface $customerVehicleRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers, guard:employee']);
        $this->customerVehicleInterface     = $customerVehicleRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function store(CreateCustomerVehicleRequest $request)
    {
        $vehicle = $this->customerVehicleInterface->createCustomerVehicle($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $vehicle->customer->id,
            'status'      => 'Vehículo Agregado',
            'employee_id' => auth()->guard('employee')->user()->id
        );
        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
        return back()->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
