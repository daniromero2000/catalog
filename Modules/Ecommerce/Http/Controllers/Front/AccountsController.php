<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Transformers\OrderTransformable;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    use OrderTransformable;
    private $customerRepo;

    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepo = $customerRepository;
    }

    public function index()
    {
        $customer = $this->customerRepo->findFrontCustomerById(auth()->user()->id);
        $customerRepo = new CustomerRepository($customer);
        $orders = $customerRepo->findOrders(['*'], 'created_at');

        $orders->transform(function (Order $order) {
            return $this->transformOrder($order);
        });

        $orders->load('products');

        return view('layouts.front.accounts.accounts', [
            'customer'  => $customer,
            'orders'    => $orders,
            'wishlist'  => $customer->wishlist,
            'addresses' => $customerRepo->findAddresses()
        ]);
    }
}
