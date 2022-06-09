<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Orders;

use Modules\Ecommerce\Entities\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;
use Modules\Ecommerce\Entities\OrderStatuses\Requests\CreateOrderStatusRequest;
use Modules\Ecommerce\Entities\OrderStatuses\Requests\UpdateOrderStatusRequest;
use App\Http\Controllers\Controller;

class OrderStatusController extends Controller
{
    private $orderStatuses;

    public function __construct(OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->middleware(['permission:orders, guard:employee']);
        $this->orderStatuses = $orderStatusRepository;
        $this->module       = 'Estados Ordenes';
    }

    public function index()
    {
        return view('ecommerce::admin.order-statuses.list', [
            'orderStatuses' => $this->orderStatuses->listOrderStatuses(),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.order-statuses.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateOrderStatusRequest $request)
    {
        $this->orderStatuses->createOrderStatus($request->except('_token', '_method'));
        return redirect()->route('admin.order-statuses.index')->with('message', config('messaging.create'));
    }

    public function edit(int $id)
    {
        return view('ecommerce::admin.order-statuses.edit', [
            'orderStatus' => $this->orderStatuses->findOrderStatusById($id)
        ]);
    }

    public function update(UpdateOrderStatusRequest $request, int $id)
    {
        $update = new OrderStatusRepository($this->orderStatuses->findOrderStatusById($id));
        $update->updateOrderStatus($request->all());
        return redirect()->route('admin.order-statuses.edit', $id)->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->orderStatuses->findOrderStatusById($id)->delete();
        return redirect()->route('admin.order-statuses.index')->with('message', config('messaging.delete'));
    }
}
