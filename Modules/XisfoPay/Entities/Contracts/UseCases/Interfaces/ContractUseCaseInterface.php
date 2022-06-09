<?php

namespace Modules\XisfoPay\Entities\Contracts\UseCases\Interfaces;


interface ContractUseCaseInterface
{
    public function listContracts(array $data): array;

    public function listCustomerContracts(array $data): array;

    public function storeContract($request);

    public function showContract(int $id);

    public function updateContract($request, int $id);

    public function destroyContract(int $id);
}
