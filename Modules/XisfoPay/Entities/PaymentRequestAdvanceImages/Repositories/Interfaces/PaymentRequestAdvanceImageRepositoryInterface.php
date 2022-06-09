<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Repositories\Interfaces;

use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\PaymentRequestAdvanceImage;

interface PaymentRequestAdvanceImageRepositoryInterface
{
    public function createPaymentRequestAdvanceImage(array $data): PaymentRequestAdvanceImage;

    public function updatePaymentRequestAdvanceImage(array $data): bool;

    public function findPaymentRequestAdvanceImageById(int $id): PaymentRequestAdvanceImage;

    public function deletePaymentRequestAdvanceImage(): bool;
}
