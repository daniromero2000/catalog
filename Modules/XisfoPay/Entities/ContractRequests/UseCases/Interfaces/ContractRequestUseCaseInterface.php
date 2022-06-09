<?php

namespace Modules\XisfoPay\Entities\ContractRequests\UseCases\Interfaces;


interface ContractRequestUseCaseInterface
{
    public function listContractRequests(array $data): array;

    public function listCustomerContractRequests(): array;

    public function createContractRequest();

    public function createFrontContractRequest();

    public function createNewContractRequest(int $id);

    public function createNewFrontContractRequest();

    public function storeContractRequest($request);

    public function storeFrontContractRequest($request);

    public function storeNewContractRequest($request, int $id);

    public function storeNewFrontContractRequest($request);

    public function showContractRequest(int $id);

    public function updateContractRequest($request, int $id);

    public function destroyContractRequest(int $id);

    public function checkIfUnapprobedRequests();
}
