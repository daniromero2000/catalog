<?php

namespace Modules\Pqrs\Mail;

use Modules\Pqrs\Entities\Pqrs\Pqr;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use League\Flysystem\Config;

class SendPqrsEmailNotificationToAdminMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $pqr;

    /**
     * Create a new message instance.
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
            'pqrs' => $this->pqr,
            'customer' => $this->pqr->email
        ];
        return $this->view('emails.admin.ItemNotificationEmail', $data);
    }
}
