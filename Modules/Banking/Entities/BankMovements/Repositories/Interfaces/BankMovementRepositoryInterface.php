<?php

namespace Modules\Banking\Entities\BankMovements\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Banking\Entities\BankMovements\BankMovement;

interface BankMovementRepositoryInterface
{
    public function createBankMovement(array $data): BankMovement;

    public function updateBankMovement(array $data): bool;

    public function findBankMovementById(int $bankMovementId): BankMovement;

    public function deleteBankMovement(): bool;

    public function searchBankMovements(string $text = null, $from = null, $to = null): LengthAwarePaginator;

    public function findLastBankMovement(int $bankAccountId): ?BankMovement;
}
