<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Repositories;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\PaymentRequestStatusesLog;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Repositories\Interfaces\PaymentRequestStatusesLogRepositoryInterface;

class PaymentRequestStatusesLogRepository implements PaymentRequestStatusesLogRepositoryInterface
{
    protected $model;

    public function __construct(PaymentRequestStatusesLog $paymentRequestStatusesLog)
    {
        $this->model = $paymentRequestStatusesLog;
    }

    public function createPaymentRequestStatusesLog(array $data): PaymentRequestStatusesLog
    {
        $paymentRequestStatusesLog              = new PaymentRequestStatusesLog($data);
        $paymentCreatedAt                       = $paymentRequestStatusesLog->paymentRequest->created_at;
        $paymentRequestStatusesLog->time_passed = $this->paymentRequestStatusDaysPassed($paymentCreatedAt);
        $paymentRequestStatusesLog->save();

        return $paymentRequestStatusesLog;
    }

    private function paymentRequestStatusDaysPassed($paymentCreatedAt)
    {
        return CarbonInterval::seconds($paymentCreatedAt->diffInSeconds(Carbon::now()))
            ->cascade()->forHumans();
    }
}
