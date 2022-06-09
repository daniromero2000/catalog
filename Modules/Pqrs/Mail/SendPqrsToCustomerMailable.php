<?php

namespace Modules\Pqrs\Mail;

use Modules\Pqrs\Entities\Pqrs\Pqr;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPqrsToCustomerMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $pqr;

    /**
     * Create a new message instance.
     *
     * @param Pqr $pqr
     */
    public function __construct(Item $pqr)
    {
        $this->pqr = $pqr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'pqr' => $this->pqr,
            'customer' => $this->pqr->email
        ];

        return $this->view('emails.customer.sendItemDetailsToCustomer', $data);
    }
}
