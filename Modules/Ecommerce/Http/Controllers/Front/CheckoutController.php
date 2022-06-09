<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Ecommerce\Entities\Checkout\Repositories\CheckoutRepository;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Epayco;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\api\PayUCountries;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\PayUPayments;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\util\PayUParameters;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\PaymentMethods;
use PhpParser\Node\Stmt\ElseIf_;

class CheckoutController extends Controller
{
    use ProductTransformable;

    private $cartRepo, $courierRepo, $addressRepo, $customerRepo, $productRepo;
    private $orderRepo, $payPal, $shippingRepo, $checkoutinterface;
    private $countryRepo, $cityRepo, $provinceRepo;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CourierRepositoryInterface $courierRepository,
        CustomerAddressRepositoryInterface $addressRepository,
        CustomerRepositoryInterface $customerRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
        ProvinceRepositoryInterface $provinceRepository,
        CheckoutRepository $checkoutRepository
    ) {
        $this->cartRepo          = $cartRepository;
        $this->courierRepo       = $courierRepository;
        $this->addressRepo       = $addressRepository;
        $this->customerRepo      = $customerRepository;
        $this->productRepo       = $productRepository;
        $this->orderRepo         = $orderRepository;
        $this->provinceRepo      = $provinceRepository;
        $this->countryRepo       = $countryRepository;
        $this->cityRepo          = $cityRepository;
        $this->checkoutinterface = $checkoutRepository;
    }

    public function index(Request $request)
    {
        $customer           = $request->user();
        $rates              = null;
        $shipment_object_id = null;
        $products           = $this->cartRepo->getCartItems();
        if (env('ACTIVATE_SHIPPING') == 1) {
            $shipment = $this->createShippingProcess($customer, $products);
            if (!is_null($shipment)) {
                $shipment_object_id = $shipment->object_id;
                $rates = $shipment->rates;
            }
        }

        $paymentGateways = explode(',', config('payees.name'));
        $paymentMethods = new PaymentMethods;
        $creditCards = [];
        $pse         = [];
        foreach ($paymentGateways as $key => $value) {
            if ($value == 'payu') {
                $pse            = $paymentMethods->getPse();
                $creditCards    = $paymentMethods->getCreditCards();
                $banksArray     = $this->getPayUBanks()->banks;
            } elseif ($value == 'epayco') {
                $creditCards    = $paymentMethods->getCreditCards();
                $epaycoClient   = new Epayco(config('epayco'));
                $banksArray     = $epaycoClient->bank->pseBank()->data;
            }
        }

        $data = ['customer_id' => $customer->id];
        $this->checkoutinterface->updateOrCreateCheckout($data);

        return view('layouts.front.checkout.checkout', [
            'customer'           => $customer,
            'countries'          => $this->countryRepo->getCountriesNames(),
            'cities'             => $this->cityRepo->getAllCityNames(),
            'provinces'          => $this->provinceRepo->getAllProvincesNames(),
            'billingAddress'     => $customer->frontCustomerAddresses()->first(),
            'addresses'          => $customer->frontCustomerAddresses()->get(),
            'products'           => $this->cartRepo->getCartItems(),
            'subtotal'           => $this->cartRepo->getSubTotal(),
            'tax'                => $this->cartRepo->getTax(),
            'total'              => $this->cartRepo->getTotal(2),
            'cartItems'          => $this->cartRepo->getCartItemsTransformed(),
            'shipment_object_id' => $shipment_object_id,
            'rates'              => $rates,
            'creditCards'        => $creditCards,
            'pse'                => $pse,
            'deviceSessionId'    => md5(session_id() . microtime()),
            'banks'              => $banksArray,
            'paymentGateways'    => $paymentGateways
        ]);
    }

    public function cancel(Request $request)
    {
        return view('ecommerce::front.checkout-cancel', [
            'data' => $request->all()
        ]);
    }

    public function getCountry($id)
    {
        if ($id > 0) {
            return $this->countryRepo->findCountryById($id)->provinces;
        }
    }

    public function getProvince($id)
    {
        if ($id > 0) {
            return $this->cityRepo->findCityByProvince($id);
        }
    }

    public function success()
    {
        return view('ecommerce::front.checkout-success');
    }

    private function createShippingProcess(Customer $customer, Collection $products)
    {
        $customerRepo = new CustomerRepository($customer);

        if ($customerRepo->findAddresses()->count() > 0 && $products->count() > 0) {

            $this->shippingRepo->setPickupAddress();
            $deliveryAddress = $customerRepo->findAddresses()->first();
            $this->shippingRepo->setDeliveryAddress($deliveryAddress);
            $this->shippingRepo->readyParcel($this->cartRepo->getCartItems());

            return $this->shippingRepo->readyShipment();
        }
    }

    public function getPayUBanks()
    {
        //Ingrese aquí el nombre del medio de pago
        $parameters = array(
            //Ingrese aquí el identificador de la cuenta.
            PayUParameters::PAYMENT_METHOD => "PSE",
            //Ingrese aquí el nombre del pais.
            PayUParameters::COUNTRY => PayUCountries::CO,
        );

        return  PayUPayments::getPSEBanks($parameters);
    }
}
