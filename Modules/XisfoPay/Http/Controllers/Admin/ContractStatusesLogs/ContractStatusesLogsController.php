<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractStatusesLogs;

use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatusesLogs\Repositories\Interfaces\ContractStatusesLogRepositoryInterface;
use Modules\XisfoPay\Entities\ContractStatusesLogs\Requests\CreateContractStatusesLogRequest;

class ContractStatusesLogsController extends Controller
{
    private $toolsInterface, $contractStatusLogInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractStatusesLogRepositoryInterface $contractStatusRepositoryInterface
    ) {
        $this->middleware(['permission:contracts, guard:employee']);
        $this->toolsInterface             = $toolRepositoryInterface;
        $this->contractStatusLogInterface = $contractStatusRepositoryInterface;
    }

    public function store(CreateContractStatusesLogRequest $request)
    {
        $this->contractStatusLogInterface->createContractStatusesLog($request->except('_token', '_method'));

        return redirect()->route('admin.contract-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function show()
    {
        return view('generals::layouts.error.404');
    }
}
