<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerPhones;

use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Modules\Customers\Entities\CustomerPhones\Requests\CreateCustomerPhoneRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerPhonesController extends Controller
{
    private $customerPhoneInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerPhoneRepositoryInterface $customerPhoneRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
        $this->customerPhoneInterface       = $customerPhoneRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function store(CreateCustomerPhoneRequest $request)
    {
        $phone = $this->customerPhoneInterface->createCustomerPhone($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $phone->customer->id,
            'status'      => 'Teléfono Agregado',
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
