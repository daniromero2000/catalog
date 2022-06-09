<?php

namespace Modules\Customers\Http\Controllers\Front\CustomerCompanies;

use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerCompanies\Requests\UpdateCustomerCompanyRequest;
use Modules\Customers\Entities\CustomerCompanies\UseCases\Interfaces\CustomerCompanyUseCaseInterface;

class CustomerCompaniesFrontController extends Controller
{
    private $customerCompanyServiceInterface;

    public function __construct(
        CustomerCompanyUseCaseInterface $customerCompanyUseCaseInterface
    ) {
        $this->customerCompanyServiceInterface = $customerCompanyUseCaseInterface;
    }

    public function update(UpdateCustomerCompanyRequest $request, $id)
    {
        $this->customerCompanyServiceInterface->updateFrontCustomerCompany($request, $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function updateLogo(UpdateCustomerCompanyRequest $request, $id)
    {
        $this->customerCompanyServiceInterface->updateFrontCustomerCompany($request, $id);
        return back()->with('message', config('messaging.update'));
    }
}
