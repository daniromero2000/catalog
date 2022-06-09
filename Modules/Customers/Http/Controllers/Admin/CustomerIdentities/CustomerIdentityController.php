<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerIdentities;

use Modules\Customers\Entities\CustomerIdentities\Requests\CreateCustomerIdentityRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerIdentities\Requests\UpdateCustomerIdentityRequest;
use Modules\Customers\Entities\CustomerIdentities\UseCases\Interfaces\CustomerIdentityUseCaseInterface;

class CustomerIdentityController extends Controller
{
    private $customerIdentityServiceInterface;

    public function __construct(
        CustomerIdentityUseCaseInterface $customerIdentityUseCaseInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
        $this->customerIdentityServiceInterface = $customerIdentityUseCaseInterface;
    }

    public function store(CreateCustomerIdentityRequest $request)
    {
        $this->customerIdentityServiceInterface->storeCustomerIdentity($request);
        return back()->with('message', config('messaging.create'));
    }

    public function update(UpdateCustomerIdentityRequest $request, $id)
    {
        $this->customerIdentityServiceInterface->updateCustomerIdentity($request, $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
