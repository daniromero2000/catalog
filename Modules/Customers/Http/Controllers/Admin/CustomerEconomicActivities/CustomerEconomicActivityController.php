<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerEconomicActivities;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerEconomicActivities\Repositories\Interfaces\CustomerEconomicActivityRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerEconomicActivityController extends Controller
{
    private $customerEconomicActivityInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerEconomicActivityRepositoryInterface $customerEconomicActivityRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
        $this->customerEconomicActivityInterface = $customerEconomicActivityRepositoryInterface;
        $this->customerInterface                 = $customerRepositoryInterface;
        $this->customerStatusesLogInterface      = $customerStatusesLogRepositoryInterface;
        $this->customerStatusesLogInterface      = $customerStatusesLogRepositoryInterface;
    }

    public function index()
    {
        return view('customers::index');
    }

    public function create()
    {
        return view('customers::create');
    }

    public function store(Request $request)
    {
        $customerEconomicActivity = $this->customerEconomicActivityInterface->createCustomerEconomicActivity($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $customerEconomicActivity->customer->id,
            'status'      => 'Actividad Económica Agregada',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);

        return $customerEconomicActivity;
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }

    public function edit($id)
    {
        return view('customers::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
