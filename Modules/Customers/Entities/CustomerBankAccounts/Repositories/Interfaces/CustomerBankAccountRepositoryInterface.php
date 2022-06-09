<?php

namespace Modules\Customers\Entities\CustomerBankAccounts\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Customers\Entities\CustomerBankAccounts\CustomerBankAccount;

interface CustomerBankAccountRepositoryInterface
{
    public function createCustomerBankAccount(array $data): CustomerBankAccount;

    public function updateCustomerBankAccount(array $data): bool;

    public function findCustomerBankAccountById(int $id): CustomerBankAccount;

    public function listCustomerBankAccounts();

    public function deleteCustomerBankAccount(): bool;

    public function searchCustomerBankAccounts(string $text = null);

    public function updateOrCreate($data);

    public function getCustomerBankAccounts(int $id);

}
