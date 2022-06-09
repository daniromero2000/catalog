<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\UseCases;

use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Repositories\Interfaces\PaymentRequestStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\UseCases\Interfaces\PaymentRequestStatusesLogUseCaseInterface;

class PaymentRequestStatusesLogUseCase implements PaymentRequestStatusesLogUseCaseInterface
{
    private $paymentRequestStatusesLogInterface;

    public function __construct(
        PaymentRequestStatusesLogRepositoryInterface $paymentRequestStatusesLogRepositoryInterface
    ) {
        $this->paymentRequestStatusesLogInterface = $paymentRequestStatusesLogRepositoryInterface;
    }

    public function storePaymentRequestStatusesLog($id, $status)
    {
        $user = auth()->guard('employee')->user() ? auth()->guard('employee')->user() : auth()->guard('web')->user();
        $data = array(
            'payment_request_id' => $id,
            'status'             => $status,
            'user'               => $user->name . ' ' . $user->last_name
        );

        $this->paymentRequestStatusesLogInterface->createPaymentRequestStatusesLog($data);
    }
}
