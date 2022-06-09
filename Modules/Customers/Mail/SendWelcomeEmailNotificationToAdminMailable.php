<?php

namespace Modules\Customers\Mail;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use League\Flysystem\Config;

class SendWelcomeEmailNotificationToAdminMailable extends Mailable
{
    use Queueable, SerializesModels, AddressTransformable;

    public $customer;

    /**
     * Create a new message instance.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'customer' => $this->customer
        ];
        return $this->view('emails.admin.RegisterNotificationEmail', $data);
    }
}
