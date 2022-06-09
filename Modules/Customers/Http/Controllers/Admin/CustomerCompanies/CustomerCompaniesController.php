<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerCompanies;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerCompanies\Requests\CreateCustomerCompanyRequest;
use Modules\Customers\Entities\CustomerCompanies\Requests\UpdateCustomerCompanyRequest;
use Modules\Customers\Entities\CustomerCompanies\UseCases\Interfaces\CustomerCompanyUseCaseInterface;

class CustomerCompaniesController extends Controller
{
    private $customerCompanyServiceInterface;

    public function __construct(
        CustomerCompanyUseCaseInterface $customerCompanyUseCaseInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
        $this->customerCompanyServiceInterface = $customerCompanyUseCaseInterface;
        $this->module                          = 'Empresas Clientes';
    }

    public function index(Request $request)
    {
        $response = $this->customerCompanyServiceInterface->listCustomerCompanies(['search' => $request->input()]);
        return view('customers::admin.customer-companies.list', $response['data']);
    }

    public function create()
    {
        $response = $this->customerCompanyServiceInterface->createCustomerCompany();

        return view('customers::admin.customer-companies.create', $response['data']);
    }

    public function store(CreateCustomerCompanyRequest $request)
    {
        $this->customerCompanyServiceInterface->storeCustomerCompany($request->except('_token', '_method'));

        return redirect()->route('admin.customer-companies.index')
            ->with('message', 'Empresa Creada Exitosamente!');
    }

    public function show($id)
    {
        return redirect()->route('admin.customer-companies.index');
    }

    public function update(UpdateCustomerCompanyRequest $request, $id)
    {
        $this->customerCompanyServiceInterface->updateCustomerCompany($request, $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function updateLogo(UpdateCustomerCompanyRequest $request, $id)
    {
        $this->customerCompanyServiceInterface->updateCustomerCompany($request, $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->customerCompanyServiceInterface->deleteCustomerCompany($id);

        return redirect()->route('admin.customer-companies.index')
            ->with('message', config('messaging.delete'));
    }
}
