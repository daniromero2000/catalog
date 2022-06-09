<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\UseCases\Interfaces;

interface PaymentRequestStatusesLogUseCaseInterface
{
    public function storePaymentRequestStatusesLog($id, $status);
}
