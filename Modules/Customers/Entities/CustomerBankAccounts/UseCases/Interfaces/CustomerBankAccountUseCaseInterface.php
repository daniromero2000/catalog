<?php

namespace Modules\Customers\Entities\CustomerBankAccounts\UseCases\Interfaces;

use Modules\Customers\Entities\CustomerBankAccounts\Requests\UpdateCustomerBankAccountRequest;

interface CustomerBankAccountUseCaseInterface
{
    public function listCustomerBankAccounts(array $data): array;

    public function storeCustomerBankAccount(array $requestData);

    public function createCustomerBankAccount();

    public function updateCustomerBankAccount($request, int $id);

    public function destroyCustomerBankAccount(int $id);

    public function storeFrontCustomerBankAccount(array $requestData);

    public function updateFrontCustomerBankAccount($request, int $id);

}
