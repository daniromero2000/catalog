<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Epayco;

class ThankUPageEpaycoPseController extends Controller
{
    private $orderInterface;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderInterface = $orderRepositoryInterface;
    }

    public function index()
    {
        $user                                 = auth()->user();
        $order                                = $this->orderInterface->findOrderByCustomerId($user->id);
        $epaycoClient                         = new Epayco(config('epayco'));
        $pse                                  = $epaycoClient->bank->get($order->orderPayments[0]->transaction_id);
        $order->orderPayments[0]->state       = $pse->data->estado;
        $order->orderPayments[0]->description = $pse->data->respuesta;
        $order->orderPayments[0]->save();

        if ($pse->data->estado == 'Aceptada') {
            $order->order_status_id = 1;
        } else if ($pse->data->estado == 'Fallida' || $pse->data->estado == 'Rechazada') {
            $order->order_status_id = 3;
        }

        $order->save();

        return view('layouts.front.thank_you_pages.pse', [
            'order'    => $order,
            'data'     => $pse->data,
            'customer' => auth()->user()->name
        ]);
    }
}
