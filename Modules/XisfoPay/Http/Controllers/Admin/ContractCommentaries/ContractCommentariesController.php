<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ContractCommentaries;

use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ContractCommentaries\Requests\CreateContractCommentaryRequest;
use Modules\XisfoPay\Entities\ContractCommentaries\UseCases\Interfaces\ContractCommentaryUseCaseInterface;

class ContractCommentariesController extends Controller
{
    private $contractCommentaryServiceInterface;

    public function __construct(
        ContractCommentaryUseCaseInterface $contractCommentaryUseCaseInterface
    ) {
        $this->middleware(['permission:contracts, guard:employee']);
        $this->contractCommentaryServiceInterface = $contractCommentaryUseCaseInterface;
    }

    public function store(CreateContractCommentaryRequest $request)
    {
        $this->contractCommentaryServiceInterface->storeContractCommentary($request);

        return redirect()->route('admin.contracts.show', $request->contract_id)
            ->with('message', config('messaging.create'));
    }
}
