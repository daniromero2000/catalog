<?php

namespace Modules\XisfoPay\Entities\PaymentBankTransfers\UseCases;

use Carbon\Carbon;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Exceptions\PaymentBankTransferNotFoundException;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Exceptions\CreatePaymentBankTransferErrorException;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\PaymentBankTransferRepository;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\UseCases\Interfaces\PaymentBankTransferUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\Interfaces\PaymentRequestAdvanceRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\UseCases\Interfaces\PaymentRequestStatusesLogUseCaseInterface;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferDone;

class PaymentBankTransferUseCase implements PaymentBankTransferUseCaseInterface
{
    private $toolsInterface, $paymentBankTransferInterface, $contractRequestInterface;
    private $paymentRequestAdvanceInterface, $paymentRequestStatusesLogServiceInterface;
    private $contractRequestStreamAccountInterface, $paymentRequestsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        PaymentBankTransferRepositoryInterface $paymentBankTransferRepositoryInterface,
        PaymentRequestAdvanceRepositoryInterface $paymentRequestAdvanceRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountRepositoryInterface,
        PaymentRequestRepositoryInterface $paymentRequestRepositoryInterface,
        PaymentRequestStatusesLogUseCaseInterface $paymentRequestStatusesLogUseCaseInterface
    ) {
        $this->toolsInterface                            = $toolRepositoryInterface;
        $this->paymentBankTransferInterface              = $paymentBankTransferRepositoryInterface;
        $this->paymentRequestAdvanceInterface            = $paymentRequestAdvanceRepositoryInterface;
        $this->paymentRequestStatusesLogServiceInterface = $paymentRequestStatusesLogUseCaseInterface;
        $this->contractRequestInterface                  = $contractRequestRepositoryInterface;
        $this->contractRequestStreamAccountInterface     = $contractRequestStreamAccountRepositoryInterface;
        $this->paymentRequestsInterface                  = $paymentRequestRepositoryInterface;
        $this->module                                    = 'Transferencias Bancarias';
    }

    public function listPaymentBankTransfers(array $data)
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'payment_bank_transfers' => $this->paymentBankTransferInterface->searchPaymentBankTransfer($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']),
                'module'                 => $this->module,
                'optionsRoutes'          => config('generals.optionRoutes'),
                'headers'                => ['Fecha', 'Master', 'Cuenta', 'Valor', 'Aprobado / Transferido', 'Pago', 'Opciones']
            ],
            'search' => $searchData['search']
        ];
    }

    public function listPaymentBankTransfersToConfirm()
    {
        return [
            'data' => [
                'payment_bank_transfers' => $this->paymentBankTransferInterface->listPaymentBankTransfersToConfirm(),
                'module'                 => $this->module,
                'optionsRoutes'          => 'admin.payment-bank-transfers',
                'headers'                => ['Fecha', 'Master', 'Cuenta', 'Valor', 'Confirmar'],
            ]
        ];
    }

    public function listCustomerPaymentBankTransfers(array $data)
    {
        $contract_requests_ids      = $this->contractRequestInterface->getCustomerContractRequests(auth()->user()->id);
        $stream_accounts_ids        = $this->contractRequestStreamAccountInterface->getCustomerStreamAccounts($contract_requests_ids);
        $payment_requests_ids       = $this->paymentRequestsInterface->getCustomerPaymentRequests($stream_accounts_ids);
        $payment_bank_transfers_ids = $this->getCustomerPaymentBankTransfers($payment_requests_ids);
        $searchData                 = $this->toolsInterface->setSearchParameters($data);

        $from            = Carbon::now()->subMonths(1);
        $to              = Carbon::now();
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        if ($searchData['fromOrigin'] != '' || $searchData['toOrigin'] != '') {
            $from     = $searchData['fromOrigin'] != '' ? $searchData['fromOrigin'] : Carbon::now()->subMonths(1);
            $to       = $searchData['toOrigin'] != '' ? $searchData['toOrigin'] : Carbon::now();
        }

        $list = $this->paymentBankTransferInterface->searchPaymentBankTransfersByCustomerId($searchData['q'], $payment_bank_transfers_ids, $from, $to);

        if ($searchData['q'] != '') {
            $searchData['search'] = true;
        }

        return [
            'data' => [
                'payment_bank_transfers' => $list,
                'module'                 => $this->module,
                'optionsRoutes'          => config('generals.optionRoutes'),
                'headers'                => ['Fecha', 'Master', 'Cuenta', 'Valor', 'Aprobado / Transferido']
            ],
            'search' => $searchData['search']
        ];
    }

    public function storeBankTransfer(array $requestData)
    {
        $paymentBankTransfer = $this->paymentBankTransferInterface->createPaymentBankTransfer($requestData);
        $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentBankTransfer->payment_request_id, 'Transferencia en proceso');
    }

    public function registerTokenAdvanceBankTransfer($request)
    {
        $paymentBankTransfer = $this->paymentBankTransferInterface->createPaymentBankTransfer($request->except('_token', '_method', 'image'));
        $paymentRequestAdvance = $this->paymentRequestAdvanceInterface->findPaymentRequestAdvanceById($request->payment_request_advance_id);
        $paymentRequestAdvance->transfer = 1;
        $paymentRequestAdvance->save();
        $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentBankTransfer->payment_request_id, 'Transferencia de Avance en proceso');
        return back()->with('message', config('messaging.create'));
    }

    public function updateBankTransfer($request, int $id)
    {
        $paymentBankTransfer = $this->getBankTransfer($id);
        $update              = new PaymentBankTransferRepository($paymentBankTransfer);
        $update->updatePaymentBankTransfer($request->except('_token', '_method'));

        if ($paymentBankTransfer->payment_request_advance_id) {
            $paymentBankTransfer->paymentRequestAdvance->payment_request_status_id = 8;
            $paymentBankTransfer->paymentRequestAdvance->save();
        } elseif ($paymentBankTransfer->payment_request_id) {
            $paymentBankTransfer->paymentRequest->payment_request_status_id = 8;
            $paymentBankTransfer->paymentRequest->save();
        }

        $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentBankTransfer->payment_request_id, 'Transferencia Realizada');
        event(new PaymentBankTransferDone($paymentBankTransfer));
        return back()
            ->with('message', config('messaging.update'));
    }

    public function destroyBankTransfer($id)
    {
        $update = new PaymentBankTransferRepository($this->getBankTransfer($id));
        $update->deletePaymentBankTransfer();
    }

    private function getBankTransfer(int $id)
    {
        return $this->paymentBankTransferInterface->findPaymentBankTransferById($id);
    }

    public function confirmTranfers($request)
    {
        foreach ($request['payments'] as $paymentBankTransferId) {
            $this->updateBankTransfer($request, $paymentBankTransferId);
        }
    }

    private function getCustomerPaymentBankTransfers($payment_requests_ids)
    {
        $payment_bank_transfers_ids = $this->paymentBankTransferInterface
            ->getCustomerPaymentBankTransfers($payment_requests_ids);
        $ids_array = [];

        foreach ($payment_bank_transfers_ids as $value) {
            array_push($ids_array, $value->id);
        }

        return $ids_array;
    }
}
