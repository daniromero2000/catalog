<?php

namespace Modules\XisfoPay\Mail\PaymentCuts;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;

class SendNewPaymentCutEmailNotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentCut;

    public function __construct(PaymentCut $paymentCut)
    {
        $this->paymentCut = $paymentCut;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'paymentCut' => $this->paymentCut
        ];

        return $this->subject('Nuevo Corte de Pago')
            ->view('xisfopay::emails.admin.payment-cuts.newPaymentCutNotificationEmail', $data);
    }
}
