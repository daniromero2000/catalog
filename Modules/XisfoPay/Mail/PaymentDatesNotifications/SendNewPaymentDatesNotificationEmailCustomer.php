<?php

namespace Modules\XisfoPay\Mail\PaymentDatesNotifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewPaymentDatesNotificationEmailCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $streamingName;

    public function __construct($streamingName)
    {
        $this->streamingName = $streamingName;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $templateRoute = 'xisfopay::emails.front.streaming-billing-cuts.billing-cut-' . strtolower($this->streamingName);
        return $this->subject('Fechas De Solicitudes De Pago XisfoPay')
            ->view($templateRoute);
    }
}