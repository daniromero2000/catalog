<?php

namespace Modules\Banking\Entities\Banks\UseCases\Interfaces;


interface BankUseCaseInterface
{
    public function listBanks(array $data): array;

    public function createBank(): array;

    public function storeBank(array $requestData): void;

    public function updateBank(array $request, int $bankId): void;

    public function destroyBank(int $bankId): void;
}
