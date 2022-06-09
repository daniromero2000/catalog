<?php

namespace Modules\XisfoPay\Entities\ContractRates\UseCases\Interfaces;

interface ContractRateUseCaseInterface
{
    public function listContractRates(array $data): array;

    public function storeContractRate(array $requestData);

    public function updateContractRate(array $request, int $id);

    public function destroyContractRate(int $id);
}
