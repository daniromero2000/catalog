<?php

namespace Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\XisfoPay\Entities\PaymentBankTransfers\PaymentBankTransfer;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Exceptions\PaymentBankTransferNotFoundException;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Exceptions\CreatePaymentBankTransferErrorException;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Exceptions\DeletingPaymentBankTransferErrorException;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Exceptions\UpdatePaymentBankTransferErrorException;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;
use Modules\XisfoPay\Mail\PaymentBankTransfers\SendCutPaymentBankTransfersEmailNotificationToAdmin;
use Modules\XisfoPay\Mail\PaymentBankTransfers\SendPaymentBankTransferDoneNotificationToCustomer;
use Modules\XisfoPay\Mail\PaymentBankTransfers\SendUnApprovedBankTransfersEmailNotificationToAdmin;

class PaymentBankTransferRepository implements PaymentBankTransferRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'payment_request_id',
        'payment_request_advance_id',
        'value',
        'is_transfered',
        'is_aprobed',
        'created_at'
    ];

    public function __construct(PaymentBankTransfer $paymentRequest)
    {
        $this->model = $paymentRequest;
    }

    public function createPaymentBankTransfer(array $data): PaymentBankTransfer
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentBankTransferErrorException($e->getMessage());
        }
    }

    public function updatePaymentBankTransfer(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePaymentBankTransferErrorException($e->getMessage());
        }
    }

    public function findPaymentBankTransferById(int $id): PaymentBankTransfer
    {
        try {
            return $this->model->with([
                'paymentRequest', 'paymentRequestAdvance'
            ])->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentBankTransferNotFoundException($e->getMessage());
        }
    }

    public function listPaymentBankTransfersToConfirm(): Collection
    {
        return $this->model->with('paymentRequest')->orderBy('id', 'desc')
            ->where('is_transfered', 0)->get($this->columns);
    }

    public function deletePaymentBankTransfer(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPaymentBankTransferErrorException($e->getMessage());
        }
    }

    public function searchPaymentBankTransfer(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPaymentBankTransfers();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentBankTransfer($text)
                ->with(['paymentRequest'])
                ->select($this->columns)
                ->orderBy('id', 'desc')->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['paymentRequest'])
                ->select($this->columns)
                ->orderBy('id', 'desc')->paginate(10);
        }

        return $this->model->searchPaymentBankTransfer($text)
            ->with(['paymentRequest'])->whereBetween('created_at', [$from, $to])
            ->select($this->columns)
            ->orderBy('id', 'desc')->paginate(10);
    }

    public function listPaymentBankTransfers()
    {
        return  $this->model->with(['paymentRequest'])
            ->select($this->columns)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getAprobedPaymentBankTransfers(): Collection
    {
        return $this->model->with(['paymentRequest'])->where('is_aprobed', 1)
            ->where('payment_cut_id', null)->get($this->columns);
    }

    public function findCutPaymentBanktransfers($paymentRequestId): Collection
    {
        return $this->model->with(['paymentRequest'])
            ->where('payment_request_id', $paymentRequestId)->get($this->columns);
    }

    public function getCutPaymentBanktransfers($paymentCut)
    {
        $paymentBankTransfers = collect([]);

        $paymentCut->paymentRequests->each(function ($paymentRequest) use ($paymentBankTransfers) {
            $paymentRequest->bankTransfers->each(function ($bankTransfers) use ($paymentBankTransfers) {
                $paymentBankTransfers->push($bankTransfers);
            });
        });

        if (!$paymentBankTransfers->isEmpty()) {
            $this->sendCutPaymentBankTransfersEmailNotificationToAdmin($paymentBankTransfers);
        }

        return true;
    }

    public function sendPaymentBankTransferToAdmin($paymentBankTransfer)
    {
        $paymentBankTransfers = collect([]);

        $paymentBankTransfers->push($paymentBankTransfer);

        if (!$paymentBankTransfers->isEmpty()) {
            $this->sendCutPaymentBankTransfersEmailNotificationToAdmin($paymentBankTransfers);
        }

        return true;
    }

    public function sendCutPaymentBankTransfersEmailNotificationToAdmin($data)
    {
        Mail::to(['email' => 'carlosq.syc@gmail.com',])->cc([
            'sycgroupsas@gmail.com'
        ])->queue(new SendCutPaymentBankTransfersEmailNotificationToAdmin($data));
    }

    public function searchPaymentBankTransfersByCustomerId(
        string $text = null,
        array $payment_bank_transfers_ids,
        $from = null,
        $to = null
    ) {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPaymentBankTransfersByCustomerId($payment_bank_transfers_ids);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentBankTransfer($text)
                ->whereIn('id', $payment_bank_transfers_ids)
                ->with(['paymentRequest'])
                ->select($this->columns)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->whereIn('id', $payment_bank_transfers_ids)
                ->with(['paymentRequest'])
                ->select($this->columns)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return $this->model->searchPaymentBankTransfer($text)
            ->with(['paymentRequest'])
            ->whereIn('id', $payment_bank_transfers_ids)
            ->whereBetween('created_at', [$from, $to])
            ->select($this->columns)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function listPaymentBankTransfersByCustomerId(array $payment_bank_transfers_ids)
    {
        return  $this->model->with(['paymentRequest'])
            ->whereIn('id', $payment_bank_transfers_ids)
            ->select($this->columns)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getCustomerPaymentBankTransfers($payment_requests_ids)
    {
        return $this->model
            ->whereIn('payment_request_id', $payment_requests_ids)
            ->get(['id']);
    }

    public function sendCustomerPaymentBankTransfersEmailNotification($paymentRequestId)
    {
        $payment_bank_transfer = $this->findPaymentBankTransferById($paymentRequestId);

        if ($payment_bank_transfer) {
            $email = $payment_bank_transfer->paymentRequest->contractRequestStreamAccount->contractRequest->customer->email;
            Mail::to(['email' => $email,])->queue(new SendPaymentBankTransferDoneNotificationToCustomer($payment_bank_transfer));
        }
    }

    public function getUnTransferredTransfers(): Collection
    {
        return $this->model->with(['paymentRequest'])->where('is_transfered', 0)
            ->get($this->columns);
    }

    public function notifyUnTransferredTransfers()
    {
        $unTransferredTransfers = $this->getUnTransferredTransfers();

        if (!$unTransferredTransfers->isEmpty()) {
            $this->sendUnTransferredBankTransfersEmailNotificationToAdmin($unTransferredTransfers);
        }
    }

    public function sendUnTransferredBankTransfersEmailNotificationToAdmin($data)
    {
        Mail::to(['email' => 'sycgroupsas@gmail.com'])->cc([
            'carlosq.syc@gmail.com',
            'financiero0.syc@gmail.com'
        ])->queue(new SendUnApprovedBankTransfersEmailNotificationToAdmin($data));
    }
}
