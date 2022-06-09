<?php

namespace Modules\XisfoPay\Mail\PaymentRequests;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;

class SendPaymenRequestApprovationNotificationToCustomer extends Mailable
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

        return $this->subject('Solicitud de Pago Aprobada')
            ->view('xisfopay::emails.admin.payment-requests.approvedPaymentRequestNotificationEmail', $data);
    }
}
