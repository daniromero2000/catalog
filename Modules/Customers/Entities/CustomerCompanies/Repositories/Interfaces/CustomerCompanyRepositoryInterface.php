<?php

namespace Modules\Customers\Entities\CustomerCompanies\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Customers\Entities\CustomerCompanies\CustomerCompany;

interface CustomerCompanyRepositoryInterface
{
    public function createCustomerCompany(array $data): CustomerCompany;

    public function updateCustomerCompany(array $data): bool;

    public function findCustomerCompanyById(int $id): CustomerCompany;

    public function deleteCustomerCompany(): bool;

    public function searchCustomerCompanies(string $text = null);

    public function updateOrCreate($data);

    public function countCustomerCompany(string $text = null,  $from = null, $to = null);

    public function enableCreateCompany($request, $customerCompanies);
}
