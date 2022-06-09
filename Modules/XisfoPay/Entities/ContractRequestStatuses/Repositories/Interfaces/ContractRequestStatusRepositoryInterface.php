<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatuses\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ContractRequestStatuses\ContractRequestStatus;

interface ContractRequestStatusRepositoryInterface
{
    public function createContractRequestStatus(array $data): ContractRequestStatus;

    public function updateContractRequestStatus(array $data): bool;

    public function findContractRequestStatusById(int $id): ContractRequestStatus;

    public function listContractRequestStatuses($totalView): Collection;

    public function deleteContractRequestStatus(): bool;

    public function searchContractRequestStatus(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countContractRequestStatus(string $text = null,  $from = null, $to = null);

    public function getAllContractRequestStatusesNames(): Collection;
}
