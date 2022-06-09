<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases\Interfaces;

use Illuminate\Support\Collection;

interface PaymentRequestAdvanceUseCaseInterface
{
    public function listPaymentRequestAdvances(array $data): array;

    public function listCustomerPaymentRequestAdvances(array $data): array;

    public function storePaymentRequestAdvance($request);

    public function showPaymentRequestAdvance(int $id);

    public function updatePaymentRequestAdvance($request, int $id);

    public function destroyPaymentRequestAdvance(int $id);

    public function removePaymentRequestAdvanceThumbnail(string $src);

    public function savePaymentRequestAdvanceImages($id, Collection $collection, $client);

    public function getTokensPrice($paymentRequestAdvance, $payment, $trm);

    public function getUSDTokensPrice($payment);

    public function sendNewPaymentRequestAdvanceEmailNotificationToAdmin($paymentRequestAdvance);
}
