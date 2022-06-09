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
use Modules\Ecommerce\Entities\PaymentMethods\PayU\Client\PayuClient;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\Contracts\PayuClientInterface;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\util\PayUParameters;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Ecommerce\Events\OrderCreateEvent;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class PsePaymentsController extends Controller
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
                'payment'         => strtolower(config('payu.name') . '-' . 'PSE'),
                'discounts'       => 0,
                'sub_total'       => $this->cartRepo->getSubTotal(),
                'grand_total'     => $this->cartRepo->getTotal(2, $courier->cost),
                'total_shipping'  => $courier->cost,
                'total_paid'      => $this->cartRepo->getTotal(2, $courier->cost),
                'tax'             => $this->cartRepo->getTax()
            ]);
            $order->payment_method =  'PSE';

            $payuClient = new PayuClient(config('payu'));
            $this->pay($payuClient, $order, $paymentDataRequest, $checkout);
            event(new OrderCreateEvent($order));

            return redirect($request->session()->get('BANK_URL'));
        }

        return back();
    }

    public function pay(PayuClientInterface $payuClient, $order, $paymentDataRequest, $checkout)
    {
        $data = [
            PayUParameters::REFERENCE_CODE => $order->reference,
            PayUParameters::DESCRIPTION => 'Pago Online fvn.com.co',
            PayUParameters::VALUE => $order->grand_total,
            PayUParameters::TAX_VALUE => $order->tax_amount,
            PayUParameters::TAX_RETURN_BASE => 0,
            PayUParameters::CURRENCY => 'COP',
            // -- Comprador --
            PayUParameters::BUYER_ID => $order->customer->id,
            PayUParameters::BUYER_NAME => $order->customer->name . ' ' . $order->customer->last_name,
            PayUParameters::BUYER_EMAIL => $order->customer->email,
            PayUParameters::BUYER_CONTACT_PHONE => $order->customer->customerPhones[0]->phone,
            PayUParameters::BUYER_DNI => "",
            PayUParameters::BUYER_STREET => $order->address->customer_address,
            PayUParameters::BUYER_STREET_2 => $order->address->customer_address,
            PayUParameters::BUYER_CITY => $order->address->city->city,
            PayUParameters::BUYER_STATE => $order->address->city->province->province,
            PayUParameters::BUYER_COUNTRY => "CO",
            PayUParameters::BUYER_POSTAL_CODE => "000000",
            PayUParameters::BUYER_PHONE => $order->customer->customerPhones[0]->phone,
            // -- Pagador --
            PayUParameters::PAYER_ID => "1",
            PayUParameters::PAYER_NAME => $paymentDataRequest['BUYER_NAME'],
            PayUParameters::PAYER_EMAIL => $order->customer->email,
            PayUParameters::PAYER_CONTACT_PHONE => $paymentDataRequest['PAYER_CONTACT_PHONE'],
            PayUParameters::PAYER_DNI => $paymentDataRequest['PAYER_DNI'],
            PayUParameters::PAYER_STREET => $order->address->customer_address,
            PayUParameters::PAYER_STREET_2 => $order->address->customer_address,
            PayUParameters::PAYER_CITY => $order->address->city->city,
            PayUParameters::PAYER_STATE => $order->address->city->province->province,
            PayUParameters::PAYER_COUNTRY => "CO",
            PayUParameters::PAYER_POSTAL_CODE => "000000",
            PayUParameters::PAYER_PHONE => $order->customer->customerPhones[0]->phone,

            PayUParameters::PAYER_PERSON_TYPE => $paymentDataRequest['PAYER_PERSON_TYPE'],
            PayUParameters::PAYER_DOCUMENT_TYPE  => $paymentDataRequest['PAYER_DOCUMENT_TYPE'],
            // -- Datos del pago --
            PayUParameters::PAYMENT_METHOD => 'PSE', // VISA, MASTERCARD, ...
            PayUParameters::PSE_FINANCIAL_INSTITUTION_CODE => $paymentDataRequest['PSE_FINANCIAL_INSTITUTION_CODE'], // VISA, MASTERCARD, ...

            PayUParameters::COUNTRY => 'CO',
            PayUParameters::DEVICE_SESSION_ID => $paymentDataRequest['DEVICE_SESSION_ID'],
            PayUParameters::IP_ADDRESS => $paymentDataRequest['ip'],
            PayUParameters::PAYER_COOKIE =>  $paymentDataRequest['PAYER_COOKIE'],
            PayUParameters::USER_AGENT => $paymentDataRequest['USER_AGENT'],
            //Solicitud de autorización y captura
            // TransactionResponse response = PayUPayments.doAuthorizationAndCapture(parameters)
        ];

        $orderRepo = new OrderRepository($order);
        $payuClient->pay($data, function ($response) use ($orderRepo, $order, $checkout) {
            $orderPaymentRepo = new OrderPayment();
            $orderPaymentRepo['transaction_id'] = $response->transactionResponse->orderId;
            $orderPaymentRepo['method'] = 'PSE';
            $orderPaymentRepo['description'] = $response->transactionResponse->pendingReason . ' ' .  $response->transactionResponse->responseCode;
            $orderPaorderPaymentRepoyment['transaction_order'] = $response->transactionResponse->trazabilityCode;
            $orderPaymentRepo['state'] = $response->transactionResponse->state;
            $orderPaymentRepo['order_id'] = $order->id;
            $order->orderPayments()->save($orderPaymentRepo);

            if ($response->code == 'SUCCESS') {
                if ($response->transactionResponse->state == 'PENDING') {
                    $orderRepo->buildOrderDetails(Cart::content());
                    Cart::destroy();
                    $this->checkoutInterface->removeCheckout($checkout);
                    return  session(['BANK_URL' => $response->transactionResponse->extraParameters->BANK_URL]);
                } else {
                    $orderRepo->removeOrder();
                }
            } else {
                $orderRepo->removeOrder();
            }
        }, function ($error) use ($orderRepo) {
            $orderRepo->removeOrder();
        });
    }
}
