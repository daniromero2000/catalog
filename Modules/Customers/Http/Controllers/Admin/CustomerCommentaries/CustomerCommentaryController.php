<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerCommentaries;

use Modules\Customers\Entities\CustomerCommentaries\Repositories\Interfaces\CustomerCommentaryRepositoryInterface;
use Modules\Customers\Entities\CustomerCommentaries\Requests\CreateCustomerCommentaryRequest;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepository;

class CustomerCommentaryController extends Controller
{
    private $customerCommentaryInterface;
    private $customerStatusesLogInterface;

    public function __construct(
        CustomerCommentaryRepositoryInterface $customerCommentaryRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers, guard:employee']);
        $this->customerCommentaryInterface  = $customerCommentaryRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
    }

    public function store(CreateCustomerCommentaryRequest $request)
    {
        $user            = ToolRepository::setStaticSignedUser();
        $request['user'] = $user->name;
        $commentary      = $this->customerCommentaryInterface->createCustomerCommentary($request->except('_token', '_method'));

        $data = array(
            'customer_id' => $commentary->customer->id,
            'status'      => 'Comentario Agregado',
            'employee_id' => $user->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
        return back()->with('message', config('messaging.create'));
    }
}
