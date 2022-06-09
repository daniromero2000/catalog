<?php

namespace Modules\Customers\Http\Controllers\Front\CustomerPhones;

use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Modules\Customers\Entities\CustomerPhones\Requests\CreateCustomerPhoneRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerPhones\Repositories\CustomerPhoneRepository;
use Modules\Customers\Entities\CustomerPhones\Requests\UpdateCustomerPhoneRequest;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerPhonesFrontController extends Controller
{
    private $customerPhoneInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerPhoneRepositoryInterface $customerPhoneRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->customerPhoneInterface       = $customerPhoneRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function store(CreateCustomerPhoneRequest $request)
    {
        $phone = $this->customerPhoneInterface->createCustomerPhone($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $phone->customer->id,
            'status'      => 'Teléfono Agregado',
            'employee_id' => 57
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
        return back()->with('message', config('messaging.create'));
    }

    public function update(UpdateCustomerPhoneRequest $request, $id)
    {
        $update = new CustomerPhoneRepository($this->customerPhoneInterface->findCustomerPhoneById($id));
        $update->updateCustomerPhone($request->except('_token', '_method'));
        return back()->with('message', 'Actualizacion Exitosa');
    }
}
