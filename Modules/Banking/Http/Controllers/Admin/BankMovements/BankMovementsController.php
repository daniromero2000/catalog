<?php

namespace Modules\Banking\Http\Controllers\Admin\BankMovements;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Banking\Entities\BankMovements\Requests\CreateBankMovementRequest;
use Modules\Banking\Entities\BankMovements\Requests\UpdateBankMovementRequest;
use Modules\Banking\Entities\BankMovements\UseCases\Interfaces\BankMovementUseCaseInterface;
use Illuminate\Contracts\View\View;

class BankMovementsController extends Controller
{
    private $bankMovementServiceInterface;

    public function __construct(
        BankMovementUseCaseInterface $bankMovementUseCaseInterface
    ) {
        $this->middleware(['permission:bank_movements, guard:employee']);
        $this->bankMovementServiceInterface = $bankMovementUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->bankMovementServiceInterface->listBankMovements(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('banking::admin.bank-movements.list', $response['data']);
    }

    public function create(): View
    {
        return view('banking::admin.bank-movements.create', $this->bankMovementServiceInterface->createBankMovement());
    }

    public function store(CreateBankMovementRequest $request)
    {
        $this->bankMovementServiceInterface->storeBankMovement($request->except('_token', '_method'));

        return redirect()->route('admin.bank-movements.index')->with('message', config('messaging.create'));
    }

    public function show(int $bankMovementId)
    {
        return view('xisfopay::admin.bank-movements.show', $this->bankMovementServiceInterface->showBankMovement($bankMovementId));
    }

    public function update(UpdateBankMovementRequest $request, int $bankMovementId)
    {
        $this->bankMovementServiceInterface->updateBankMovement($request->except('_token', '_method'), $bankMovementId);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $bankMovementId)
    {
        $this->bankMovementServiceInterface->destroyBankMovement($bankMovementId);
        return back()->with('message', config('messaging.delete'));
    }
}
