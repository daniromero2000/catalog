<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\OrderShipments;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\OrderShippingRepository;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingRepositoryInterface;
use Modules\Ecommerce\Entities\OrderShippings\Requests\CreateOrderShippingRequest;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces\OrderShippingItemInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class OrderShipmentController extends Controller
{
    private $orderRepo, $orderShippingInterf, $orderShippingItemInterf, $orderShippingRepo, $customerRepo, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        OrderRepositoryInterface $orderRepository,
        OrderShippingRepositoryInterface $orderShippingInterface,
        OrderShippingItemInterface $orderShippingItemInterface,
        OrderShippingRepository $orderShippingRepoInterfe,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->middleware(['permission:orders, guard:employee']);
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->orderRepo               = $orderRepository;
        $this->orderShippingInterf     = $orderShippingInterface;
        $this->orderShippingItemInterf = $orderShippingItemInterface;
        $this->orderShippingRepo       = $orderShippingRepoInterfe;
        $this->customerRepo            = $customerRepository;
        $this->module                  = 'Despachos de Ordenes';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->has('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->orderShippingInterf->searchOrderShipments(request()->input('q'), $skip * 10);
            $paginate = $this->orderShippingInterf->countOrderShipments(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } else if ((request()->has('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->orderShippingInterf->searchOrderShipments(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->orderShippingInterf->countOrderShipments(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->orderShippingInterf->countOrderShipments(null);
            $list     = $this->orderShippingInterf->list($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);
        $company_id = auth()->guard('employee')->user()->subsidiary->company_id;

        return view('ecommerce::admin.order-shipments.list', [
            'shipments'     => $list,
            'employee_id'   => auth()->guard('employee')->user()->id,
            'company_id'    => $company_id,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.order-shipments.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateOrderShippingRequest $request)
    {
        $request['employee_id']   = auth()->guard('employee')->user()->id;
        $request['company_id']    = auth()->guard('employee')->user()->subsidiary->company_id;
        $request['subsidiary_id'] = auth()->guard('employee')->user()->subsidiary->id; // este hay que borrarlo porque sobra
        $shipment                 = $this->orderShippingInterf->createOrderShipping($request->except('_token', '_method'));
        $orderId                  = $request->order_id;
        $order                    = $this->orderRepo->findOrderById($orderId);
        $orderRepo                = new OrderRepository($order);
        $products                 = $orderRepo->listOrderedProducts();
        // tratar de optimizzar con attach
        foreach ($products as $item) {
            $cant   =   $item->quantity;
            for ($i = 1; $i <= $cant;) {
                $shipmentItems = array(
                    'name'           =>  $item->name,
                    //'description'    =>  $item->description,
                    'sku'            =>  $item->sku,
                    'qty'            =>  1,
                    'weight'         =>  $item->weight,
                    'price'          =>  $item->price,
                    'base_price'     =>  $item->base_price,
                    'total'          =>  '0.00',
                    'base_total'     =>  '0.00',
                    'shipment_id'    =>   $shipment->id
                );
                $this->orderShippingItemInterf->createOrderShippingItem($shipmentItems);
                $i++;
            }
        }

        return redirect()->route('admin.order-shipments.index')->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $orderShipment      =   $this->orderShippingRepo->findOrderShipment($id);
        $customer           =   $this->customerRepo->findCustomerByIdforShipment($orderShipment->order->customer_id);
        $courier            =   $orderShipment->courier->name;
        $address            =   $orderShipment->order->address->customer_address;
        $city               =   $orderShipment->order->address->city->city;
        return view('ecommerce::admin.order-shipments.show', [
            'customer'              =>  $customer,
            'orderShipment'         =>  $orderShipment,
            'courier'               =>  $courier,
            'address'               =>  $address,
            'city'                  =>  $city
        ]);
    }

    public function edit($id)
    {
        return view('ecommerce::admin.order-shipments.edit');
    }
}
