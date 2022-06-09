<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Repositories\Interfaces;

use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\PaymentRequestStatusesLog;

interface PaymentRequestStatusesLogRepositoryInterface
{
    public function createPaymentRequestStatusesLog(array $data): PaymentRequestStatusesLog;
}
