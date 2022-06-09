<?php

namespace Modules\Customers\Http\Controllers\Front\CustomerReferences;

use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerReferences\Requests\CreateCustomerReferenceRequest;
use Modules\Customers\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Modules\Customers\Entities\CustomerReferences\Repositories\CustomerReferenceRepository;
use Modules\Customers\Entities\CustomerReferences\Requests\UpdateCustomerReferenceRequest;

class CustomerReferenceFrontController extends Controller
{
    private $customerReferenceInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerReferenceRepositoryInterface $customerReferenceRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface,
        CustomerPhoneRepositoryInterface $customerPhoneRepositoryInterface
    ) {
        $this->customerReferenceInterface   = $customerReferenceRepositoryInterface;
        $this->customerInterface            = $customerRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->customerPhoneInterface       = $customerPhoneRepositoryInterface;
    }

    public function store(CreateCustomerReferenceRequest $request)
    {
        $reference = $this->customerReferenceInterface->createCustomerReference($request->except('_token', '_method'));

        $data = array(
            'customer_id' => $reference->customer_id,
            'status'      => 'Referencia agregada',
            'employee_id' => 57
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
        return back()->with('message', config('messaging.create'));
    }

    public function update(UpdateCustomerReferenceRequest $request, $id)
    {
        $update = new CustomerReferenceRepository($this->customerReferenceInterface->findCustomerReferenceById($id));
        $update->updateCustomerReference($request->except('_token', '_method'));
        return back()->with('message', config('messaging.update'));
    }
}
