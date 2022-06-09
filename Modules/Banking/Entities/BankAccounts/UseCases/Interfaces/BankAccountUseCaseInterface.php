<?php

namespace Modules\Banking\Entities\BankAccounts\UseCases\Interfaces;

interface BankAccountUseCaseInterface
{
    public function listBankAccounts(array $data): array;

    public function createBankAccount(): array;

    public function storeBankAccount(array $requestData): void;

    public function showBankAccount(int $id): array;

    public function updateBankAccount(array $request, int $id): void;

    public function destroyBankAccount(int $id): void;
}
