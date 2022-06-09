<?php

namespace Modules\XisfoPay\Entities\PaymentRequests\UseCases\Interfaces;

interface PaymentRequestUseCaseInterface
{
    public function listPaymentRequests(array $data): array;

    public function createPaymentRequest();

    public function createFromPaymentRequest();

    public function storePaymentRequest($request);

    public function showPaymentRequest(int $id);

    public function updatePaymentRequest($request, int $id);

    public function destroyPaymentRequest(int $id);

    public function removePaymentRequestThumbnail(string $src);

    public function liquidatePaymentRequest($payment);

    public function updatePaymentRequests($paymentCut, $uncutPayments);

    public function resetePaymentRequestValues($paymentCut);

    public function sendCustomerPaymentRequestApproveNotification($paymentRequests);

    public function addPaymentRequestToCut($requestData);

    public function pendingPaymentRequests();

    public function approvePaymentRequests($requestData);
}
