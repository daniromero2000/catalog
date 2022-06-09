<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Orders;

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
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\PayUReports;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\util\PayUParameters;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class OrderController extends Controller
{
    private $orderRepo, $courierRepo, $customerRepo, $orderStatusRepo, $orderShippingRepo;
    private $toolsInterface;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CourierRepositoryInterface $courierRepository,
        CustomerRepositoryInterface $customerRepository,
        OrderStatusRepositoryInterface $orderStatusRepository,
        OrderShippingRepositoryInterface $orderShippingRepoInterfe,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->middleware(['permission:orders, guard:employee']);
        $this->orderRepo         = $orderRepository;
        $this->courierRepo       = $courierRepository;
        $this->customerRepo      = $customerRepository;
        $this->orderStatusRepo   = $orderStatusRepository;
        $this->orderShippingRepo = $orderShippingRepoInterfe;
        $this->toolsInterface    = $toolRepositoryInterface;
        $this->module            = 'Ordenes';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->orderRepo->searchOrder(request()->input('q'), $skip * 10);
            $paginate = $this->orderRepo->countOrder(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->orderRepo->searchOrder(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->orderRepo->countOrder(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->orderRepo->countOrder(null);
            $list     = $this->orderRepo->listOrders($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('ecommerce::admin.orders.list', [
            'orders'        => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function show($orderId)
    {
        $order          = $this->orderRepo->findOrderById($orderId);
        $orderRepo      = new OrderRepository($order);
        $order->courier = $orderRepo->getCouriers()->first();
        $order->address = $orderRepo->getAddresses()->first();
        $items          = $orderRepo->listOrderedProducts();
        $couriers       = $this->courierRepo->listCouriers()->pluck('name', 'id');
        $orderShipment  = $order->orderShipment;
        $cant   = 0;
        $weight = 0.00;

        foreach ($items as $item) {
            $cant   += $item->quantity;
            $weight += $item->weight * number_format($item->quantity, 2);
        }

        return view('ecommerce::admin.orders.show', [
            'order'         => $order,
            'items'         => $items,
            'statuses'      => $this->orderStatusRepo->listOrderStatuses(),
            'customer'      => $this->customerRepo->findCustomerById($order->customer_id),
            'currentStatus' => $this->orderStatusRepo->findOrderStatusById($order->order_status_id),
            'payment'       => $order->payment,
            'user'          => auth()->guard('employee')->user(),
            'couriers'      => $couriers,
            'cant'          => $cant,
            'weight'        => $weight,
            'orderShipment' => $orderShipment
        ]);
    }

    public function edit($orderId)
    {
        $order = $this->orderRepo->findOrderById($orderId);

        $orderRepo      = new OrderRepository($order);
        $order->courier = $orderRepo->getCouriers()->first();
        $order->address = $orderRepo->getAddresses()->first();
        $items          = $orderRepo->listOrderedProducts();

        return view('ecommerce::admin.orders.edit', [
            'statuses'      => $this->orderStatusRepo->listOrderStatuses(),
            'order'         => $order,
            'items'         => $items,
            'customer'      => $this->customerRepo->findCustomerById($order->customer_id),
            'currentStatus' => $this->orderStatusRepo->findOrderStatusById($order->order_status_id),
            'payment'       => $order->payment,
            'user'          => auth()->guard('employee')->user()
        ]);
    }

    public function update(Request $request, $orderId)
    {
        $order     = $this->orderRepo->findOrderById($orderId);
        $orderRepo = new OrderRepository($order);

        if ($request->has('total_paid') && $request->input('total_paid') != null) {
            $orderData = $request->except('_method', '_token');
        } else {
            $orderData = $request->except('_method', '_token', 'total_paid');
        }

        if ($request->input('order_status_id') == 6) {
            $order->orderProducts->each(function ($orderProduct) {
                if ($orderProduct->attribute) {
                    $orderProduct->attribute->quantity += $orderProduct->quantity;
                    $orderProduct->attribute->save();
                } else {
                    $orderProduct->qty = $orderProduct->quantity;
                }
            });
        }

        $orderRepo->updateOrder($orderData);

        return redirect()->route('admin.orders.show', $orderId);
    }

    public function generateInvoice(int $id)
    {
        $order = $this->orderRepo->findOrderById($id);

        $data = [
            'order'     => $order,
            'products'  => $order->products,
            'customer'  => $order->customer,
            'courier'   => $order->courier,
            'address'   => $order->address,
            'status'    => $order->orderStatus,
            'payment'   => $order->paymentMethod
        ];

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('ecommerce::invoices.orders', $data)->stream();
        return $pdf->stream();
    }

    private function transFormOrder(Collection $list)
    {
        $courierRepo     = new CourierRepository(new Courier());
        $customerRepo    = new CustomerRepository(new Customer());
        $orderStatusRepo = new OrderStatusRepository(new OrderStatus());

        return $list->transform(function (Order $order) use ($courierRepo, $customerRepo, $orderStatusRepo) {
            $order->courier  = $courierRepo->findCourierById($order->courier_id);
            $order->customer = $customerRepo->findCustomerById($order->customer_id);
            $order->status   = $orderStatusRepo->findOrderStatusById($order->order_status_id);
            return $order;
        })->all();
    }

    public function checkPayUPsePaymentStatus($paymentId)
    {
        $parameters = array(PayUParameters::ORDER_ID => $paymentId);
        $payment = PayUReports::getOrderDetail($parameters);
        $order = $this->orderRepo->findOrderByReference($payment->referenceCode);
        $orderPayment = $order->orderpayments[0];

        if ($payment->transactions[0]->transactionResponse->state == 'APPROVED') {
            $order->order_status_id = 1;
        } elseif ($payment->transactions[0]->transactionResponse->state == 'DECLINED') {
            $order->order_status_id = 3;
        } else {
            $order->order_status_id = 2;
        }

        $order->save();
        $orderPayment->state = $payment->transactions[0]->transactionResponse->state;
        $orderPayment->save();

        return redirect()->route('admin.orders.show', $order->id);
    }
}
