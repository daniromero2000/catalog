<?php

namespace Modules\XisfoPay\Entities\Contracts\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\Contracts\Contract;

interface ContractRepositoryInterface
{
    public function createContract(array $data): Contract;

    public function updateContract(array $data): bool;

    public function findContractById(int $id): Contract;

    public function listContracts();

    public function deleteContract(): bool;

    public function searchContract(string $text = null, $from = null, $to = null);

    public function activateContract($contract);

    public function checkIfInActiveContracts();

    public function setUpdateLogStatus($contract, $request);

    public function findInActiveContracts(): Collection;

    public function getCustomerContracts($contract_requests_ids);

    public function listContractsByCustomerId($payment_requests_ids);

    public function searchContractsByCustomerId(string $text = null, $contracts_ids);
}
