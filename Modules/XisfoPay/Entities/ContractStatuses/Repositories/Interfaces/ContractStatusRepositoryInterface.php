<?php

namespace Modules\XisfoPay\Entities\ContractStatuses\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ContractStatuses\ContractStatus;

interface ContractStatusRepositoryInterface
{
    public function createContractStatus(array $data): ContractStatus;

    public function updateContractStatus(array $data): bool;

    public function findContractStatusById(int $id): ContractStatus;

    public function listContractStatuses($totalView): Collection;

    public function deleteContractStatus(): bool;

    public function searchContractStatus(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countContractStatus(string $text = null,  $from = null, $to = null);

    public function getAllContractStatusesNames(): Collection;
}
