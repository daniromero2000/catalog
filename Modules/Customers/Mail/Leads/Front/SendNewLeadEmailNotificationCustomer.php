<?php

namespace Modules\Customers\Mail\Leads\Front;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Customers\Entities\Leads\Lead;

class SendNewLeadEmailNotificationCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;

    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'lead'  => $this->lead
        ];

        return $this->subject('Registro formulario Le Femme Studio')
            ->view('customers::emails.Leads.Front.newLeadNotificationCustomerEmail', $data);
    }
}
