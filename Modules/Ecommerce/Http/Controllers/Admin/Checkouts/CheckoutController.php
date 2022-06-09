<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Checkouts;

use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Ecommerce\Entities\Couriers\Repositories\CourierRepository;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Checkout\Repositories\Interfaces\CheckoutRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CheckoutController extends Controller
{
    private $checkoutRepo, $customerRepo, $toolsInterface;

    public function __construct(
        CheckoutRepositoryInterface $checkoutRepository,
        CustomerRepositoryInterface $customerRepository,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->middleware(['permission:orders, guard:employee']);
        $this->checkoutInterface = $checkoutRepository;
        $this->customerRepo      = $customerRepository;
        $this->toolsInterface    = $toolRepositoryInterface;
        $this->module            = 'Checkouts';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->has('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->checkoutInterface->searchCheckouts(request()->input('q'), $skip * 10);
            $paginate = $this->checkoutInterface->countCheckouts(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } else if ((request()->has('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->checkoutInterface->searchCheckouts(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->checkoutInterface->countCheckouts(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->checkoutInterface->countCheckouts(null);
            $list     = $this->checkoutInterface->list($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('ecommerce::admin.checkouts.list', [
            'checkouts'     => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'headers'       => ['Nombre', 'Estado', 'Logo', 'Opciones'],
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function show($checkoutId)
    {
        $checkout = $this->checkoutInterface->findCheckoutById($checkoutId);

        return view('ecommerce::admin.checkouts.show', [
            'checkout'      => $checkout,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'items'         => $checkout->products,
            'customer'      => $checkout->customer
        ]);
    }

    public function edit($orderId)
    {
        $order = $this->orderRepo->findOrderById($orderId);

        $orderRepo = new OrderRepository($order);
        $order->courier = $orderRepo->getCouriers()->first();
        $order->address = $orderRepo->getAddresses()->first();
        $items = $orderRepo->listOrderedProducts();

        return view('ecommerce::admin.orders.edit', [
            'statuses' => $this->orderStatusRepo->listOrderStatuses(),
            'order' => $order,
            'items' => $items,
            'customer' => $this->customerRepo->findCustomerById($order->customer_id),
            'currentStatus' => $this->orderStatusRepo->findOrderStatusById($order->order_status_id),
            'payment' => $order->payment,
            'user' => auth()->guard('employee')->user()
        ]);
    }

    public function update(Request $request, $orderId)
    {
        $order = $this->orderRepo->findOrderById($orderId);
        $orderRepo = new OrderRepository($order);

        if ($request->has('total_paid') && $request->input('total_paid') != null) {
            $orderData = $request->except('_method', '_token');
        } else {
            $orderData = $request->except('_method', '_token', 'total_paid');
        }

        $orderRepo->updateOrder($orderData);

        return redirect()->route('admin.orders.edit', $orderId);
    }

    public function generateInvoice(int $id)
    {
        $order = $this->orderRepo->findOrderById($id);

        $data = [
            'order' => $order,
            'products' => $order->products,
            'customer' => $order->customer,
            'courier' => $order->courier,
            'address' => $order->address,
            'status' => $order->orderStatus,
            'payment' => $order->paymentMethod
        ];

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('ecommerce::invoices.orders', $data)->stream();
        return $pdf->stream();
    }

    private function transFormOrder(Collection $list)
    {
        $courierRepo = new CourierRepository(new Courier());
        $customerRepo = new CustomerRepository(new Customer());
        $orderStatusRepo = new OrderStatusRepository(new OrderStatus());

        return $list->transform(function (Order $order) use ($courierRepo, $customerRepo, $orderStatusRepo) {
            $order->courier = $courierRepo->findCourierById($order->courier_id);
            $order->customer = $customerRepo->findCustomerById($order->customer_id);
            $order->status = $orderStatusRepo->findOrderStatusById($order->order_status_id);
            return $order;
        })->all();
    }
}
