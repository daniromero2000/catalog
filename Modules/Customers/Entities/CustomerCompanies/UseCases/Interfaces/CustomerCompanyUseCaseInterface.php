<?php

namespace Modules\Customers\Entities\CustomerCompanies\UseCases\Interfaces;

use Modules\Customers\Entities\CustomerCompanies\Requests\UpdateCustomerCompanyRequest;

interface CustomerCompanyUseCaseInterface
{
    public function listCustomerCompanies(array $requestData);

    public function createCustomerCompany();
    
    public function storeCustomerCompany(array $requestData);

    public function updateCustomerCompany($request, int $id);

    public function updateFrontCustomerCompany($request, int $id);

    public function deleteCustomerCompany(int $id);

}
