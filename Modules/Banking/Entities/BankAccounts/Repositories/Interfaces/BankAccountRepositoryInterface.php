<?php

namespace Modules\Banking\Entities\BankAccounts\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Banking\Entities\BankAccounts\BankAccount;

interface BankAccountRepositoryInterface
{
    public function createBankAccount(array $data): BankAccount;

    public function updateBankAccount(array $data): bool;

    public function findBankAccountById(int $bankAccountId): BankAccount;

    public function deleteBankAccount(): bool;

    public function searchBankAccounts(string $text = null, $from = null, $to = null): LengthAwarePaginator;

    public function findActiveBankAccounts(): Collection;
}
