<?php

namespace Modules\Banking\Entities\Banks\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Banking\Entities\Banks\Bank;

interface BankRepositoryInterface
{
    public function createBank(array $data): Bank;

    public function updateBank(array $data): bool;

    public function findBankById(int $bankId): Bank;

    public function searchBank(string $text = null): LengthAwarePaginator;

    public function getAllBankNames(): Collection;

    public function getBankDraftRate(int $bankId): Bank;

    public function findBankProcessingCommission($bankId): Bank;
}
