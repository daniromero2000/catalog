<?php

namespace Modules\Ecommerce\Http\Controllers\Front\Payments;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Checkout\Repositories\CheckoutRepository;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Modules\Ecommerce\Entities\OrderPayments\OrderPayment;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\util\PayUParameters;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Epayco;
use Modules\Ecommerce\Events\OrderCreateEvent;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class PseEpaycoPaymentsController extends Controller
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
                'order_status_id' => 5,
                'payment'         => strtolower(config('epayco.name') . '-' . 'PSE'),
                'discounts'       => 0,
                'sub_total'       => $this->cartRepo->getSubTotal(),
                'grand_total'     => $this->cartRepo->getTotal(2, $courier->cost),
                'total_shipping'  => $courier->cost,
                'total_paid'      => $this->cartRepo->getTotal(2, $courier->cost),
                'tax'             => $this->cartRepo->getTax()
            ]);
            $order->payment_method = 'PSE';
            $epaycoClient          = new Epayco(config('epayco'));
            $this->pay($epaycoClient, $order, $paymentDataRequest, $checkout);
            event(new OrderCreateEvent($order));

            return redirect($request->session()->get('BANK_URL'));
        }

        return back();
    }

    public function pay($epaycoClient, $order, $paymentDataRequest, $checkout)
    {
        $data = [
            "bank"                => $paymentDataRequest['PSE_FINANCIAL_INSTITUTION_CODE'],
            "invoice"             => $order->reference,
            "description"         => 'Pago Online tiendatukan.com',
            "value"               => $order->grand_total,
            "tax"                 => $order->tax_amount,
            "tax_base"            => 0,
            "currency"            => "COP",
            "type_person"         => $paymentDataRequest['PAYER_PERSON_TYPE'],
            "doc_type"            => $paymentDataRequest['PAYER_DOCUMENT_TYPE'],
            "doc_number"          => $paymentDataRequest['PAYER_DNI'],
            "name"                => $order->customer->name,
            "last_name"           => $order->customer->last_name,
            "email"               => $order->customer->email,
            "country"             => "CO",
            "cell_phone"          => $order->customer->customerPhones[0]->phone,
            "ip"                  => $paymentDataRequest['ip'],  // This is the client's IP, it is required
            "url_response"        => "https://www.tiendatukan.com/thankupage-epayco-pse",
            "url_confirmation"    => "https://www.tiendatukan.com/thankupage-epayco-pse",
            "method_confirmation" => "GET"
        ];

        $pse                                               = $epaycoClient->bank->create($data);
        $orderRepo                                         = new OrderRepository($order);
        $orderPaymentRepo                                  = new OrderPayment();
        $orderPaymentRepo['transaction_id']                = $pse->data->transactionID;
        $orderPaymentRepo['method']                        = 'PSE';
        $orderPaymentRepo['description']                   = $pse->data->respuesta;
        $orderPaorderPaymentRepoyment['transaction_order'] = $pse->data->transactionID;
        $orderPaymentRepo['state']                         = $pse->data->estado;
        $orderPaymentRepo['order_id']                      = $order->id;
        $order->orderPayments()->save($orderPaymentRepo);

        if ($pse->success == true) {
            if ($pse->data->estado == 'Pendiente') {
                $orderRepo->buildOrderDetails(Cart::content());
                Cart::destroy();
                $this->checkoutInterface->removeCheckout($checkout);
                return  session(['BANK_URL' => $pse->data->urlbanco]);
            } else {
                $orderRepo->removeOrder();
            }
        } else {
            $orderRepo->removeOrder();
        }
    }
}
