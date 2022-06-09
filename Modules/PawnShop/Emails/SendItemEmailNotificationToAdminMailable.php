<?php

namespace App\Mail;

use App\Shop\Items\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendItemEmailNotificationToAdminMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $item;

    /**
     * Create a new message instance.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'items' => $this->item,
            'customer' => $this->item->customer
        ];
        return $this->view('emails.admin.ItemNotificationEmail', $data);
    }
}
