<?php

namespace Modules\Customers\Mail\Leads\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Customers\Entities\Leads\Lead;

class SendNewLeadEmailNotificationAdmin extends Mailable
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

        return $this->subject('Nuevo registro formulario Le Femme Studio')
            ->view('customers::emails.Leads.Admin.newLeadNotificationAdminEmail', $data);
    }
}
