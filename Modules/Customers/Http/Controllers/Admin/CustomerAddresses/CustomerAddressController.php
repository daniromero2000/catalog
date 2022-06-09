<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerAddresses;

use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerAddresses\Requests\CreateCustomerAddressRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerAddresses\Repositories\CustomerAddressRepository;
use Modules\Customers\Entities\CustomerAddresses\Requests\UpdateCustomerAddressRequest;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerAddressController extends Controller
{
    private $customerAddressInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerAddressRepositoryInterface $customerAddressRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
        $this->customerAddressInterface     = $customerAddressRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function store(CreateCustomerAddressRequest $request)
    {
        $address =  $this->customerAddressInterface->createCustomerAddress($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $address->customer->id,
            'status'      => 'Residencia Agregada',
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

    public function update(UpdateCustomerAddressRequest $request, $id)
    {
        $update = new CustomerAddressRepository($this->customerAddressInterface->findAddressById($id));
        $update->updateCustomerAddress($request->except('_token', '_method'));
        return back()->with('message', config('messaging.update'));
    }
}
