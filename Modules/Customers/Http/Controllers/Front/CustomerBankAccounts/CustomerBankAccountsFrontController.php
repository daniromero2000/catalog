<?php

namespace Modules\Customers\Http\Controllers\Front\CustomerBankAccounts;

use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerBankAccounts\Requests\CreateCustomerBankAccountRequest;
use Modules\Customers\Entities\CustomerBankAccounts\Requests\UpdateCustomerBankAccountRequest;
use Modules\Customers\Entities\CustomerBankAccounts\UseCases\Interfaces\CustomerBankAccountUseCaseInterface;

class CustomerBankAccountsFrontController extends Controller
{
    private $customerBankAccountServiceInterface;

    public function __construct(
        CustomerBankAccountUseCaseInterface $customerBankAccountUseCaseInterface
    ) {
        $this->customerBankAccountServiceInterface = $customerBankAccountUseCaseInterface;
    }

    public function store(CreateCustomerBankAccountRequest $request)
    {
        $this->customerBankAccountServiceInterface->storeFrontCustomerBankAccount($request->except(['_token', '_method']));
        return back()
            ->with('message', config('messaging.create'));
    }

    public function update(UpdateCustomerBankAccountRequest $request, $id)
    {
        $this->customerBankAccountServiceInterface->updateFrontCustomerBankAccount($request, $id);
        return back()
            ->with('message', config('messaging.update'));
    }
}
