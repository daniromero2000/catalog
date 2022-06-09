<?php

namespace Modules\Customers\Http\Controllers\Front\CustomerEmails;

use Modules\Customers\Entities\CustomerEmails\Repositories\Interfaces\CustomerEmailRepositoryInterface;
use Modules\Customers\Entities\CustomerEmails\Requests\CreateCustomerEmailRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerEmails\Repositories\CustomerEmailRepository;
use Modules\Customers\Entities\CustomerEmails\Requests\UpdateCustomerEmailRequest;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerEmailFrontController extends Controller
{
    private $customerEmailInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerEmailRepositoryInterface $customerEmailRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->customerEmailInterface       = $customerEmailRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function store(CreateCustomerEmailRequest $request)
    {
        $email = $this->customerEmailInterface->createCustomerEmail($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $email->customer->id,
            'status'      => 'Email Agregado',
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

    public function update(UpdateCustomerEmailRequest $request, $id)
    {
        $update = new CustomerEmailRepository($this->customerEmailInterface->findCustomerEmailById($id));
        $update->updateCustomerEmail($request->except('_token', '_method'));
        return back()->with('message', 'Correo actualizado exitosamente');
    }
}
