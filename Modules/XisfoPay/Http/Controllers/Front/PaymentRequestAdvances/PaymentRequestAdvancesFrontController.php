<?php

namespace Modules\XisfoPay\Http\Controllers\Front\PaymentRequestAdvances;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\ContractRequestStreamAccountRepository;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\PaymentRequestAdvanceNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\Interfaces\PaymentRequestAdvanceRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases\Interfaces\PaymentRequestAdvanceUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\Interfaces\PaymentRequestStatusRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Repositories\Interfaces\PaymentRequestStatusesLogRepositoryInterface;

class PaymentRequestAdvancesFrontController extends Controller
{
    private $toolsInterface, $paymentRequestAdvancesInterface, $paymentRequestStatusInterface, $paymentRequestsInterface;
    private $paymentRequestStatusesLogInterface, $contractRequestsInterface, $contractRequestsStreamAccountsInterface;
    private $paymentRequestAdvanceServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        PaymentRequestAdvanceRepositoryInterface $paymentRequestAdvanceRepositoryInterface,
        PaymentRequestStatusRepositoryInterface $paymentRequestStatusRepositoryInterface,
        PaymentRequestStatusesLogRepositoryInterface $paymentRequestStatusesLogRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountRepositoryInterface,
        PaymentRequestRepositoryInterface $paymentRequestRepositoryInterface,
        PaymentRequestAdvanceUseCaseInterface $paymentRequestAdvanceUseCaseInterface
    ) {
        $this->middleware('PaymentRequestAdvanceIsOwner', ['only' => ['show']]);
        $this->toolsInterface                          = $toolRepositoryInterface;
        $this->paymentRequestAdvancesInterface         = $paymentRequestAdvanceRepositoryInterface;
        $this->paymentRequestStatusInterface           = $paymentRequestStatusRepositoryInterface;
        $this->paymentRequestStatusesLogInterface      = $paymentRequestStatusesLogRepositoryInterface;
        $this->contractRequestsInterface               = $contractRequestRepositoryInterface;
        $this->contractRequestsStreamAccountsInterface = $contractRequestStreamAccountRepositoryInterface;
        $this->paymentRequestsInterface                = $paymentRequestRepositoryInterface;
        $this->paymentRequestAdvanceServiceInterface   = $paymentRequestAdvanceUseCaseInterface;
        $this->module                                  = 'Prestamos';

    }

    public function index(Request $request)
    {
        $response = $this->paymentRequestAdvanceServiceInterface->listCustomerPaymentRequestAdvances(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::front.payment-request-advances.list', $response['data']);
    }

    public function create()
    {
        return redirect()->route('account.payment-request-advances.index')
            ->with('error', config('messaging.not_found'));
    }

    public function store(Request $request)
    {
        return redirect()->route('account.payment-request-advances.index')
            ->with('error', config('messaging.not_found'));
    }

    public function show($id)
    {
        try {
            $paymentRequest =  $this->paymentRequestAdvanceServiceInterface->showPaymentRequestAdvance($id);
        } catch (PaymentRequestAdvanceNotFoundException $e) {
            return redirect()->route('account.payment-request-advances.index')
                ->with('error', 'No se encuentra el pago que estás buscando');
        }

        return view('xisfopay::front.payment-request-advances.show', $paymentRequest);
    }

    public function edit($id)
    {
        return redirect()->route('account.payment-request-advances.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('account.payment-request-advances.index')
            ->with('error', config('messaging.not_found'));
    }

    public function destroy($id)
    {
        return redirect()->route('account.payment-request-advances.index')
            ->with('error', config('messaging.not_found'));
    }
}
