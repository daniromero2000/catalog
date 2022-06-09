<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerEmails;

use Modules\Customers\Entities\CustomerEmails\Repositories\Interfaces\CustomerEmailRepositoryInterface;
use Modules\Customers\Entities\CustomerEmails\Requests\CreateCustomerEmailRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerEmailController extends Controller
{
    private $customerEmailInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerEmailRepositoryInterface $customerEmailRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
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
}
