<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ChaseTransferAmounts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\CreateChaseTransferAmountErrorException;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Requests\CreateChaseTransferAmountRequest;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Requests\UpdateChaseTransferAmountRequest;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\UseCases\Interfaces\ChaseTransferAmountUseCaseInterface;

class ChaseTransferAmountsController extends Controller
{
    private $chaseTransferAmountServiceInterface;

    public function __construct(
        ChaseTransferAmountUseCaseInterface $chaseTransferAmountUseCaseInterface
    ) {
        $this->middleware(['permission:chase_transfer_amounts, guard:employee']);
        $this->chaseTransferAmountServiceInterface = $chaseTransferAmountUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->chaseTransferAmountServiceInterface->listChaseTransferAmounts(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.chase-transfer-amounts.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::admin.chase-transfer-amounts.create', $this->chaseTransferAmountServiceInterface->createChaseTransferAmount());
    }

    public function store(CreateChaseTransferAmountRequest $request)
    {
        $this->chaseTransferAmountServiceInterface->storeChaseTransferAmount($request);


        return back()->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        return view('xisfopay::admin.chase-transfer-amounts.show', $this->chaseTransferAmountServiceInterface->showChaseTransferAmount($id));
    }

    public function update(UpdateChaseTransferAmountRequest $request, int $id)
    {
        $this->chaseTransferAmountServiceInterface->updateChaseTransferAmount($request->except('_token', '_method'), $id);
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->chaseTransferAmountServiceInterface->destroyChaseTransferAmount($id);

        return redirect()->route('admin.chase-transfer-amounts.index')
            ->with('message', config('messaging.delete'));
    }
}
