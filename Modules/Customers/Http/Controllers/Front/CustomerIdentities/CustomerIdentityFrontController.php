<?php

namespace Modules\Customers\Http\Controllers\Front\CustomerIdentities;

use Modules\Customers\Entities\CustomerIdentities\Requests\CreateCustomerIdentityRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerIdentities\Requests\UpdateCustomerIdentityRequest;
use Modules\Customers\Entities\CustomerIdentities\UseCases\Interfaces\CustomerIdentityUseCaseInterface;

class CustomerIdentityFrontController extends Controller
{
    private $customerIdentityServiceInterface;

    public function __construct(
        CustomerIdentityUseCaseInterface $customerIdentityUseCaseInterface
    ) {
        $this->customerIdentityServiceInterface = $customerIdentityUseCaseInterface;
    }

    public function store(CreateCustomerIdentityRequest $request)
    {
        $this->customerIdentityServiceInterface->storeFrontCustomerIdentity($request);
        return back()->with('message', config('messaging.create'));
    }

    public function update(UpdateCustomerIdentityRequest $request, $id)
    {
        $this->customerIdentityServiceInterface->updateFrontCustomerIdentity($request, $id);
        return back()->with('message', config('messaging.update'));
    }
}
