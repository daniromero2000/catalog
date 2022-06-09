<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerEpss;

use Modules\Customers\Entities\CustomerEpss\Repositories\Interfaces\CustomerEpsRepositoryInterface;
use Modules\Customers\Entities\CustomerEpss\Requests\CreateCustomerEpsRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerEpsController extends Controller
{
    private $customerEpsInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerEpsRepositoryInterface $customerEpsRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers, guard:employee']);
        $this->customerEpsInterface         = $customerEpsRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function store(CreateCustomerEpsRequest $request)
    {
        $eps = $this->customerEpsInterface->createCustomerEps($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $eps->customer->id,
            'status'      => 'Eps Agregada',
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
