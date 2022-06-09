<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces;

use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\ContractRequestStreamAccount;
use Illuminate\Support\Collection;

interface ContractRequestStreamAccountRepositoryInterface
{
    public function createContractRequestStreamAccount(array $data);

    public function searchContractRequestStreamAccount(string $text = null, int $commercialId = null);

    public function listContractRequestStreamAccounts($commercialId);

    public function findContractRequestStreamAccountById(int $id): ContractRequestStreamAccount;

    public function deleteContractRequestStreamAccount(): bool;

    public function getAllStreamAccountNames(): Collection;

    public function activateStreamingAccounts($contractRequestStreamAccount);

    public function getCustomerStreamAccounts($contract_requests_ids);

    public function getCustomerStreamAccountsNames($contract_requests_ids): Collection;

    public function findStreamingContractRequests(int $streamingId): Collection;
}
