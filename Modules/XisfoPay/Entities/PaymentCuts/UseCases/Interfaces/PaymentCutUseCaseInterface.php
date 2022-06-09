<?php

namespace Modules\XisfoPay\Entities\PaymentCuts\UseCases\Interfaces;

interface PaymentCutUseCaseInterface
{
    public function listPaymentCuts(array $data): array;

    public function createPaymentCut();

    public function storePaymentCut(array $requestData);

    public function showPaymentCut(int $id);

    public function updatePaymentCut(array $request, int $id);

    public function destroyPaymentCut(int $id);
}
