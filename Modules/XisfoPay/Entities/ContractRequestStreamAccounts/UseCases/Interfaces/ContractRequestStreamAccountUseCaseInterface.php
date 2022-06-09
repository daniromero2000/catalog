<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccounts\UseCases\Interfaces;

interface ContractRequestStreamAccountUseCaseInterface
{
    public function listContractRequestStreamAccount(array $requestData);

    public function createContractRequestStreamAccount();

    public function storeContractRequestStreamAccount($request);

    public function updateContractRequestStreamAccount($request, int $id);

    public function deleteContractRequestStreamAccount(int $id);

    public function sendPaymentDatesNotifications(array $streamingsIds);
}
