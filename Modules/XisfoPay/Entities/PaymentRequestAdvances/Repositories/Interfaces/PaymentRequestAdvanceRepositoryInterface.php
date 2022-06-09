<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\Interfaces;

use Modules\XisfoPay\Entities\PaymentRequestAdvances\PaymentRequestAdvance;

interface PaymentRequestAdvanceRepositoryInterface
{
    public function createPaymentRequestAdvance(array $data): PaymentRequestAdvance;

    public function updatePaymentRequestAdvance(array $data): bool;

    public function findPaymentRequestAdvanceById(int $id): PaymentRequestAdvance;

    public function listPaymentRequestAdvances();

    public function deletePaymentRequestAdvance(): bool;

    public function searchPaymentRequestAdvance(string $text = null, $from = null, $to = null);

    public function deleteThumb(string $src): bool;

    public function listPaymentRequestAdvancesByCustomerId($payment_requests_advances_ids);

    public function searchPaymentRequestAdvanceByCustomerId(string $text = null,  $payment_requests_advances_ids, $from = null, $to = null);

    public function getCustomerPaymentRequestsAdvances($payment_requests_ids);
}
