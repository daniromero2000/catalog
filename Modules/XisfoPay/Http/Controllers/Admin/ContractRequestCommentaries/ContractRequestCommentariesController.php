<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractRequestCommentaries;

use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\Requests\CreateContractRequestCommentaryRequest;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\UseCases\Interfaces\ContractRequestCommentaryUseCaseInterface;

class ContractRequestCommentariesController extends Controller
{
    private $contractCommentaryServiceInterface;

    public function __construct(
        ContractRequestCommentaryUseCaseInterface $contractCommentaryUseCaseInterface
    ) {
        $this->middleware(['permission:contract_requests, guard:employee']);
        $this->contractCommentaryServiceInterface = $contractCommentaryUseCaseInterface;
    }

    public function store(CreateContractRequestCommentaryRequest $request)
    {
        $this->contractCommentaryServiceInterface->storeContractRequestCommentary($request);

        return redirect()->route('admin.contract-requests.show', $request->contract_request_id)
            ->with('message', config('messaging.create'));
    }
}
