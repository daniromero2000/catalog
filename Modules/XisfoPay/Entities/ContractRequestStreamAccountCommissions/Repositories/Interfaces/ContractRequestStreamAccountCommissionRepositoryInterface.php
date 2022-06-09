<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\ContractRequestStreamAccountCommission;

interface ContractRequestStreamAccountCommissionRepositoryInterface
{
    public function createContractRequestStreamAccountCommission(array $data): ContractRequestStreamAccountCommission;

    public function updateContractRequestStreamAccountCommission(array $data): bool;

    public function findContractRequestStreamAccountCommissionById(int $id): ContractRequestStreamAccountCommission;

    public function deleteContractRequestStreamAccountCommission(): bool;

    public function searchContractRequestStreamAccountCommissions(string $text = null, $from = null, $to = null);

    public function findCommissionByStreaming(int $streamingId);

    public function getAllStreamAccountCommissions(): Collection;
}
