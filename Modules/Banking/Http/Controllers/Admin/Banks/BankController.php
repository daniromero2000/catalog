<?php

namespace Modules\Banking\Http\Controllers\Admin\Banks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Banking\Entities\Banks\Requests\CreateBankRequest;
use Modules\Banking\Entities\Banks\Requests\UpdateBankRequest;
use Modules\Banking\Entities\Banks\UseCases\Interfaces\BankUseCaseInterface;
use Illuminate\Contracts\View\View;

class BankController extends Controller
{
    private $bankUseCaseInterface;

    public function __construct(
        BankUseCaseInterface $bankUseCaseInterface
    ) {
        $this->middleware(['permission:banks, guard:employee']);
        $this->bankUseCaseInterface = $bankUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->bankUseCaseInterface->listBanks(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('banking::admin.banks.list', $response['data']);
    }

    public function create(): View
    {
        return view('banking::admin.banks.create', $this->bankUseCaseInterface->createBank());
    }

    public function store(CreateBankRequest $request)
    {
        $this->bankUseCaseInterface->storeBank($request->except('_token', '_method'));

        return redirect()->route('admin.banks.index')->with('message', config('messaging.create'));
    }

    public function show(int $bankId)
    {
        return back()->with('error', config('messaging.not_found'));
    }

    public function update(UpdateBankRequest $request, int $bankId)
    {
        $this->bankUseCaseInterface->updateBank($request->except('_token', '_method'), $bankId);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $bankId)
    {
        $this->bankUseCaseInterface->destroyBank($bankId);
        return back()->with('message', config('messaging.delete'));
    }
}
