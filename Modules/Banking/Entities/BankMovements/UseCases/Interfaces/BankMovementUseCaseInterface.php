<?php

namespace Modules\Banking\Entities\BankMovements\UseCases\Interfaces;


interface BankMovementUseCaseInterface
{
    public function listBankMovements(array $data): array;

    public function createBankMovement(): array;

    public function storeBankMovement(array $requestData): void;

    public function showBankMovement(int $id): array;

    public function updateBankMovement(array $request, int $id): void;

    public function destroyBankMovement(int $id): void;
}
