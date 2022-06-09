<?php

namespace Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;

interface PaymentRequestRepositoryInterface
{
    public function createPaymentRequest(array $data): PaymentRequest;

    public function updatePaymentRequest(array $data): bool;

    public function findPaymentRequestById(int $id): PaymentRequest;

    public function deletePaymentRequest(): bool;

    public function searchPaymentRequest(string $text = null, $from = null, $to = null, int $commercialId = null);

    public function getAprobedPaymentRequests(): Collection;

    public function deleteThumb(string $src): bool;

    public function getCustomerPaymentRequests($stream_accounts_ids);

    public function listPaymentRequestsByCustomerId($payment_requests_ids);

    public function searchPaymentRequestsByCustomerId(string $text = null, $payment_requests_ids, $from = null, $to = null);

    public function sendPaymentRequestApprovattionNotificationToCustomer();

    public function findPendingPayments(array $chaseTransfersIds): Collection;

    public function findPendingPaymentRequests(): Collection;
}
