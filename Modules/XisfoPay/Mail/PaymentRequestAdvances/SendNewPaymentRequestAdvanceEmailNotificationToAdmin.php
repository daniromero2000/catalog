<?php

namespace Modules\XisfoPay\Mail\PaymentRequestAdvances;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\PaymentRequestAdvance;

class SendNewPaymentRequestAdvanceEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentRequestAdvance;

    public function __construct(PaymentRequestAdvance $paymentRequestAdvance)
    {
        $this->paymentRequestAdvance = $paymentRequestAdvance;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'paymentRequestAdvance' => $this->paymentRequestAdvance
        ];

        return $this->subject('Nueva Solicitud de Prestamo')
            ->view('xisfopay::emails.admin.payment-request-advances.newPaymentRequestAdvanceNotificationEmail', $data);
    }
}
