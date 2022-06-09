<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractRequestStatusesLogs;

use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Repositories\Interfaces\ContractRequestStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Requests\CreateContractRequestStatusesLogRequest;

class ContractRequestStatusesLogsController extends Controller
{
    private  $contractStatusLogInterface;

    public function __construct(
        ContractRequestStatusesLogRepositoryInterface $contractStatusRepositoryInterface
    ) {
        $this->middleware(['permission:contract_requests, guard:employee']);
        $this->contractStatusLogInterface = $contractStatusRepositoryInterface;
    }

    public function store(CreateContractRequestStatusesLogRequest $request)
    {
        $this->contractStatusLogInterface->createContractRequestStatusesLog($request->except('_token', '_method'));

        return redirect()->route('admin.contract-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function show()
    {
        return view('generals::layouts.error.404');
    }
}
