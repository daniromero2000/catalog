<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\OrderCommentaries;

use Modules\Ecommerce\Entities\OrderCommentaries\Repositories\Interfaces\OrderCommentaryRepositoryInterface;
use Modules\Ecommerce\Entities\OrderCommentaries\Requests\CreateOrderCommentaryRequest;
use Modules\Ecommerce\Entities\OrderStatusesLogs\Repositories\Interfaces\OrderStatusesLogRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepository;

class OrderCommentaryController extends Controller
{
    private $orderCommentaryInterface;
    private $orderStatusesLogInterface;

    public function __construct(
        OrderCommentaryRepositoryInterface $orderCommentaryRepositoryInterface,
        OrderStatusesLogRepositoryInterface $orderStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:orders, guard:employee']);
        $this->orderCommentaryInterface  = $orderCommentaryRepositoryInterface;
        $this->orderStatusesLogInterface = $orderStatusesLogRepositoryInterface;
    }

    public function store(CreateOrderCommentaryRequest $request)
    {
        $user = ToolRepository::setStaticSignedUser();
        $request['user'] = $user->name . ' ' . $user->last_name;
        $commentary =  $this->customerCommentaryInterface->createOrderCommentary($request->except('_token', '_method'));

        $data = array(
            'customer_id' => $commentary->customer->id,
            'status'      => 'Comentario Agregado',
            'employee_id' => $user->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
        return back()->with('message', config('messaging.create'));
    }
}
