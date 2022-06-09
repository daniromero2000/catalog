<?php

namespace Modules\Ecommerce\Mail;

use Modules\Customers\Entities\CustomerAddresses\Transformations\AddressTransformable;
use Modules\Ecommerce\Entities\Orders\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderToCustomerMailable extends Mailable
{
    use Queueable, SerializesModels, AddressTransformable;

    public $order;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'order'    => $this->order,
            'products' => $this->order->products,
            'customer' => $this->order->customer,
            'courier'  => $this->order->courier,
            'address'  => $this->order->address,
            'status'   => $this->order->orderStatus,
            'payment'  => $this->order->payment_method
        ];

        return $this->subject('Orden de Compra FVN')
            ->view('ecommerce::emails.customer.sendOrderDetailsToCustomer', $data);
    }
}