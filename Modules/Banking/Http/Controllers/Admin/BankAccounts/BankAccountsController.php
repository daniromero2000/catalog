<?php

namespace Modules\Banking\Http\Controllers\Admin\BankAccounts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Banking\Entities\BankAccounts\Requests\CreateBankAccountRequest;
use Modules\Banking\Entities\BankAccounts\Requests\UpdateBankAccountRequest;
use Modules\Banking\Entities\BankAccounts\UseCases\Interfaces\BankAccountUseCaseInterface;
use Illuminate\Contracts\View\View;

class BankAccountsController extends Controller
{
    private $bankAccountServiceInterface;

    public function __construct(
        BankAccountUseCaseInterface $bankAccountUseCaseInterface
    ) {
        $this->middleware(['permission:bank_accounts, guard:employee']);
        $this->bankAccountServiceInterface = $bankAccountUseCaseInterface;
    }

    public function index(Request $request): view
    {
        $response = $this->bankAccountServiceInterface->listBankAccounts(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('banking::admin.bank-accounts.list', $response['data']);
    }

    public function create(): view
    {
        return view('banking::admin.bank-accounts.create', $this->bankAccountServiceInterface->createBankAccount());
    }

    public function store(CreateBankAccountRequest $request)
    {
        $this->bankAccountServiceInterface->storeBankAccount($request->except('_token', '_method'));

        return redirect()->route('admin.bank-accounts.index')->with('message', config('messaging.create'));
    }

    public function show(int $bankAccountId)
    {
        return view('banking::admin.bank-accounts.show', $this->bankAccountServiceInterface->showBankAccount($bankAccountId));
    }

    public function update(UpdateBankAccountRequest $request, int $bankAccountId)
    {
        $this->bankAccountServiceInterface->updateBankAccount($request->except('_token', '_method'), $bankAccountId);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $bankAccountId)
    {
        $this->bankAccountServiceInterface->destroyBankAccount($bankAccountId);
        return back()->with('message', config('messaging.delete'));
    }
}
