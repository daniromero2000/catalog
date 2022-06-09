<?php

namespace Modules\XisfoPay\Entities\ContractRenewals\UseCases\Interfaces;

interface ContractRenewalUseCaseInterface
{
    public function listContractRenewals(array $data): array;

    public function storeContractRenewal(array $requestData);

    public function updateContractRenewal($request, int $id);

    public function destroyContractRenewal(int $id);

    public function checkIfUnapprobedRenewals();

    public function checkIfExpiredRenewals();

    public function setRenewalDates(int $id);
}
