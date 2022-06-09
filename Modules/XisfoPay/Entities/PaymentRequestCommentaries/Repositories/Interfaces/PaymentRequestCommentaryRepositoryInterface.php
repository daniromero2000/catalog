<?php

namespace Modules\XisfoPay\Entities\PaymentRequestCommentaries\Repositories\Interfaces;

use Modules\XisfoPay\Entities\PaymentRequestCommentaries\PaymentRequestCommentary;

interface PaymentRequestCommentaryRepositoryInterface
{
    public function createPaymentRequestCommentary(array $data): PaymentRequestCommentary;
}
