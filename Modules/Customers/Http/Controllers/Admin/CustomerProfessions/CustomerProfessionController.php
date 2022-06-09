<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerProfessions;

use Modules\Customers\Entities\CustomerProfessions\Repositories\Interfaces\CustomerProfessionRepositoryInterface;
use Modules\Customers\Entities\CustomerProfessions\Requests\CreateCustomerProfessionRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerProfessionController extends Controller
{
    private $customerProfessionInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerProfessionRepositoryInterface $customerProfessionRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers, guard:employee']);
        $this->customerProfessionInterface = $customerProfessionRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function store(CreateCustomerProfessionRequest $request)
    {
        $profession =  $this->customerProfessionInterface->createCustomerProfession($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $profession->customer->id,
            'status'      => 'Profesión Agregada',
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
