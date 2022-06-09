<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\UseCases\Interfaces;

interface ContractRequestStreamAccountCommissionUseCaseInterface
{
    public function listContractRequestStreamAccountCommissions(array $data): array;

    public function createContractRequestStreamAccountCommission();

    public function storeContractRequestStreamAccountCommission(array $requestData);

    public function showContractRequestStreamAccountCommission(int $id);

    public function updateContractRequestStreamAccountCommission(array $request, int $id);

    public function destroyContractRequestStreamAccountCommission(int $id);
}
