<?php

namespace Modules\XisfoPay\Mail\PaymentRequests;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;

class SendNewPaymentRequestEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentRequest;

    public function __construct(PaymentRequest $paymentRequest)
    {
        $this->paymentRequest = $paymentRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'paymentRequest' => $this->paymentRequest
        ];

        return $this->subject('Nueva Solicitud de Pago')
            ->view('xisfopay::emails.admin.payment-requests.newPaymentRequestNotificationEmail', $data);
    }
}
