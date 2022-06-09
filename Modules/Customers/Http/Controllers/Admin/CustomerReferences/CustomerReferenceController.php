<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerReferences;

use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerReferences\Requests\CreateCustomerReferenceRequest;
use Modules\Customers\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use Modules\Customers\Entities\CustomerReferences\Repositories\CustomerReferenceRepository;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use Modules\Customers\Entities\CustomerReferences\Requests\UpdateCustomerReferenceRequest;

class CustomerReferenceController extends Controller
{
    private $customerReferenceInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerReferenceRepositoryInterface $customerReferenceRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
        $this->customerReferenceInterface   = $customerReferenceRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->module                       = 'Referencias Clientes';
    }

    public function index()
    {
        return view('customers::index');
    }

    public function create()
    {
        return view('customers::admin.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateCustomerReferenceRequest $request)
    {
        $reference = $this->customerReferenceInterface->createCustomerReference($request->except('_token', '_method'));

        $data = array(
            'customer_id' => $reference->customer_id,
            'status'      => 'Referencia Agregada',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
        return back()->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.customers.index')
            ->with('error', config('messaging.not_found'));
    }

    public function edit($id)
    {
        return view('customers::edit');
    }

    public function update(UpdateCustomerReferenceRequest $request, $id)
    {
        $customerReference = $this->customerReferenceInterface->findCustomerReferenceById($id);

        $data = array(
            'contractRenewal_id'    => $customerReference->id,
            'status'                => 'Referencia actualizada',
            'user'                  => auth()->guard('employee')->user()->name
        );

        $update = new CustomerReferenceRepository($customerReference);
        $update->updateCustomerReference($request->except('_token', '_method'));
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->customerReferenceInterface->findCustomerReferenceById($id)->delete();

        return redirect()->route('admin.customers.index')
            ->width('message', config('messaging.deleted'));
    }
}
