<?php

namespace Modules\Ecommerce\Http\Controllers\Front\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Checkout\Repositories\CheckoutRepository;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Modules\Ecommerce\Entities\OrderPayments\OrderPayment;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\Client\PayuClient;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\Contracts\PayuClientInterface;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\util\PayUParameters;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Epayco;
use Modules\Ecommerce\Events\OrderCreateEvent;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;


class EpaycoCreditCardPaymentsController extends Controller
{
    private $cartRepo, $checkoutInterface, $toolInterface;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CheckoutRepository $checkoutRepository,
        CourierRepositoryInterface $courierRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->cartRepo          = $cartRepository;
        $this->courierInterface  = $courierRepositoryInterface;
        $this->checkoutInterface = $checkoutRepository;
        $this->toolInterface     = $toolRepositoryInterface;
    }

    public function store(Request $request)
    {
        if (!empty($this->cartRepo->getCartItems()->toArray())) {

            $paymentDataRequest = $request->input();
            $paymentDataRequest = $this->toolInterface->getClientServerData($paymentDataRequest);
            $checkout           = $this->checkoutInterface->getLastCheckout();
            $courier            = $this->courierInterface->getCourier();
            $checkoutRepo       = new CheckoutRepository($checkout);

            $order = $checkoutRepo->buildPayUCheckoutItems([
                'reference'       => Uuid::uuid4()->toString(),
                'courier_id'      => $courier->id, // @deprecated
                'customer_id'     => $request->user()->id,
                'address_id'      => $request->input('billingAddress'),
                'order_status_id' => 1,
                'payment'         => strtolower(config('epayco.name') . '-' . $paymentDataRequest['PAYMENT_METHOD']),
                'discounts'       => 0,
                'sub_total'       => $this->cartRepo->getSubTotal(),
                'grand_total'     => $this->cartRepo->getTotal(2, $courier->cost),
                'total_shipping'  => $courier->cost,
                'total_paid'      => $this->cartRepo->getTotal(2, $courier->cost),
                'tax'             => $this->cartRepo->getTax()
            ]);

            $order->payment_method =  'epayco';
            $epaycoClient = new Epayco(config('epayco'));
            $pay = $this->pay($epaycoClient, $order, $paymentDataRequest, $checkout);

            if ($pay->data->estado == 'Aceptada') {
                event(new OrderCreateEvent($order));
                return redirect()->route('thankupage_epayco_pse')
                    ->with('message', 'Orden Exitosa!');
            } else {
                return redirect()->route('checkout.index')
                    ->with('error', 'Proceso Rechazado!' . ' ' . $pay->data->estado . ' ' .  $pay->data->respuesta);
            }
        }

        return back();
    }

    public function pay($epaycoClient, $order, $paymentDataRequest, $checkout)
    {
        $customer = $epaycoClient->customer->getList();
        $client_id = null;
        foreach ($customer->data as $key => $value) {
            if ($value->email == $order->customer->email) {
                $client_id = $value->id_customer;
            }
        }

        $token = $epaycoClient->token->create(array(
            "card[number]"    => $paymentDataRequest['CREDIT_CARD_NUMBER'],
            "card[exp_year]"  => $paymentDataRequest['age'],
            "card[exp_month]" => $paymentDataRequest['day'],
            "card[cvc]"       => $paymentDataRequest['CREDIT_CARD_SECURITY_CODE']
        ));

        $customer = $epaycoClient->customer->create(array(
            "token_card" => $token->id,
            "name"       => $order->customer->name,
            "last_name"  => $order->customer->last_name, //This parameter is optional
            "email"      => $order->customer->email,
            "default"    => true,
            "city"       => $order->address->city->city,
            "address"    => $order->address->customer_address,
            "phone"      => $order->customer->customerPhones[0]->phone,
            "cell_phone" => $order->customer->customerPhones[0]->phone
        ));

        $pay = $epaycoClient->charge->create(array(
            "token_card"       => $token->id,
            "customer_id"      => $client_id,
            "doc_type"         => "CC",
            "doc_number"       => $order->customer->customerIdentities[0]->identity_number,
            "name"             => $order->customer->name,
            "last_name"        => $order->customer->last_name,
            "email"            => $order->customer->email,
            "bill"             => $order->reference,
            "description"      => 'Pago Online tiendatukan.com',
            "value"            => $order->grand_total,
            "tax"              => strval($order->tax_amount),
            "tax_base"         => '0',
            "currency"         => "COP",
            "dues"             => $paymentDataRequest['INSTALLMENTS_NUMBER'],
            "address"          => $order->address->customer_address,
            "phone"            => $order->customer->customerPhones[0]->phone,
            "cell_phone"       => $order->customer->customerPhones[0]->phone,
            "ip"               => $paymentDataRequest['ip'],  // This is the client's IP, it is required
            "url_response"        => "https://www.tiendatukan.com/thankupage-epayco-pse",
            "url_confirmation"    => "https://www.tiendatukan.com/thankupage-epayco-pse",
            //Extra params: These params are optional and can be used by the commerce
            "use_default_card_customer" => true,/*if the user wants to be charged with the card that the customer currently has as default = true*/
        ));

        $orderRepo                             = new OrderRepository($order);
        $orderPaymentRepo                      = new OrderPayment();
        $orderPaymentRepo['transaction_id']    = $pay->data->ref_payco;
        $orderPaymentRepo['method']            = 'CREDIT';
        $orderPaymentRepo['description']       = $pay->data->estado . ' ' .  $pay->data->respuesta;
        $orderPaymentRepo['transaction_order'] = $pay->data->recibo;
        $orderPaymentRepo['state']             = $pay->data->estado;
        $orderPaymentRepo['order_id']          = $order->id;
        $order->orderPayments()->save($orderPaymentRepo);


        if ($pay->success == true) {
            if ($pay->data->estado == 'Aceptada') {
                $orderRepo->buildOrderDetails(Cart::content());
                Cart::destroy();
                $this->checkoutInterface->removeCheckout($checkout);
            } else {
                $order->order_status_id = 3;
                $order->save();
                $orderRepo->removeOrder();
            }
        } else {
            $order->order_status_id = 3;
            $order->save();
            $orderRepo->removeOrder();
        }

        return $pay;
    }
}
