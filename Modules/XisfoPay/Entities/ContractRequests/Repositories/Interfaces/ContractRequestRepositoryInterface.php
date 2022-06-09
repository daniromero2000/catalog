<?php

namespace Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;

interface ContractRequestRepositoryInterface
{
    public function createContractRequest(array $data): ContractRequest;

    public function updateContractRequest(array $data): bool;

    public function findContractRequestById(int $id): ContractRequest;

    public function listContractRequests();

    public function listContractRequestsFront($id);

    public function deleteContractRequest(): bool;

    public function searchContractRequest(string $text = null, $from = null, $to = null);

    public function updateOrCreate($data);

    public function listIds(): Collection;

    public function getAllContractRequestNames();

    public function findUnapprobedContractRequests(): Collection;

    public function getCustomerContractRequests(int $customerId);

    public function findCustomerContractRequests(int $customerId, $contract_request_type);

    public function getCustomerContracts(int $customer_id);
}
