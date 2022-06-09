<?php

namespace Modules\XisfoPay\Entities\ContractRates\Repositories\Interfaces;

use Modules\XisfoPay\Entities\ContractRates\ContractRate;

interface ContractRateRepositoryInterface
{
    public function createContractRate(array $data);

    public function getAllContractRates();

    public function findContractRateById(int $id): ContractRate;

    public function updateContractRate(array $data): bool;

    public function searchContractRate(string $text = null);
}
