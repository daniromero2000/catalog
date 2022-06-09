<?php

namespace Modules\XisfoPay\Entities\ContractRenewals\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ContractRenewals\ContractRenewal;

interface ContractRenewalRepositoryInterface
{
    public function createContractRenewal(array $data): ContractRenewal;

    public function updateContractRenewal(array $data): bool;

    public function findContractRenewalById(int $id): ContractRenewal;

    public function listContractRenewals();

    public function deleteContractRenewal(): bool;

    public function searchContractRenewal(string $text = null, $from = null, $to = null);

    public function findUnapprobedContractRenewals(): Collection;

    public function findExpiredContractRenewals(): Collection;
}
