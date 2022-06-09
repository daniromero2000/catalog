<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerBankAccounts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerBankAccounts\Requests\CreateCustomerBankAccountRequest;
use Modules\Customers\Entities\CustomerBankAccounts\Requests\UpdateCustomerBankAccountRequest;
use Modules\Customers\Entities\CustomerBankAccounts\UseCases\Interfaces\CustomerBankAccountUseCaseInterface;

class CustomerBankAccountsController extends Controller
{
    private $customerBankAccountServiceInterface;

    public function __construct(
        CustomerBankAccountUseCaseInterface $customerBankAccountUseCaseInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
        $this->customerBankAccountServiceInterface = $customerBankAccountUseCaseInterface;
        $this->module                              = 'Cuentas Bancos Clientes';
    }

    public function index(Request $request)
    {
        $response = $this->customerBankAccountServiceInterface->listCustomerBankAccounts(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('customers::admin.customer-bank-accounts.list', $response['data']);
    }

    public function create()
    {
        $response = $this->customerBankAccountServiceInterface->createCustomerBankAccount();
        return view('customers::admin.customer-bank-accounts.create', $response['data']);
    }

    public function store(CreateCustomerBankAccountRequest $request)
    {
        $this->customerBankAccountServiceInterface->storeCustomerBankAccount($request->except(['_token', '_method']));
        return back()->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        return redirect()->route('admin.customer-bank-accounts.index');
    }

    public function edit($id)
    {
        return redirect()->route('admin.customer-bank-accounts.index');
    }

    public function update(UpdateCustomerBankAccountRequest $request, $id)
    {
        $this->customerBankAccountServiceInterface->updateCustomerBankAccount($request, $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->customerBankAccountServiceInterface->destroyCustomerBankAccount($id);

        return redirect()->route('admin.customer-bank-accounts.index')
            ->with('message', config('messaging.delete'));
    }
}
