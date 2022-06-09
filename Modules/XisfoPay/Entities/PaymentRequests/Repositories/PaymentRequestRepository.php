<?php

namespace Modules\XisfoPay\Entities\PaymentRequests\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\PaymentRequestNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\CreatePaymentRequestErrorException;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\DeletingPaymentRequestErrorException;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\UpdatePaymentRequestErrorException;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;
use Modules\XisfoPay\Mail\PaymentRequests\SendNewPaymentRequestEmailNotificationToAdmin;
use Modules\XisfoPay\Mail\PaymentRequests\SendPaymenRequestApprovationNotificationToCustomer;

class PaymentRequestRepository implements PaymentRequestRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'contract_request_stream_account_id',
        'usd_amount',
        'trm',
        'commission',
        'real_commission',
        'advances',
        'subtotal',
        '4x1000',
        'grand_total',
        'payment_request_status_id',
        'is_aprobed',
        'payment_type',
        'payment_cut_id',
        'customer_bank_account_id',
        'is_aprobed',
        'usd_gain',
        'finantial_retention',
        'invoice',
        'chase_transfer_id',
        'created_at'
    ];

    public function __construct(
        PaymentRequest $paymentRequest
    ) {
        $this->model = $paymentRequest;
    }

    public function createPaymentRequest(array $data): PaymentRequest
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentRequestErrorException($e->getMessage());
        }
    }

    public function updatePaymentRequest(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePaymentRequestErrorException($e->getMessage());
        }
    }

    public function findPaymentRequestById(int $id): PaymentRequest
    {
        try {
            return $this->model->with([
                'paymentRequestStatus',
                'paymentRequestCommentaries',
                'paymentRequestStatusesLogs',
                'paymentRequestAdvances',
                'contractRequestStreamAccount',
                'bankTransfers',
                'customerBankAccount',
                'hasUnAprobedAdvances',
                'hasAprovedBankTransfers',
                'chaseTransfer'
            ])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentRequestNotFoundException($e->getMessage());
        }
    }

    public function deletePaymentRequest(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPaymentRequestErrorException($e->getMessage());
        }
    }

    public function searchPaymentRequest(string $text = null, $from = null, $to = null, int $commercialId = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPaymentRequests($commercialId);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentRequest($text)
                ->with(['contractRequestStreamAccount'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->where(function ($q) use ($commercialId) {
                    if ($commercialId != null) {
                        $q->whereHas('contractRequestStreamAccount', function ($k) use ($commercialId) {
                            $k->whereHas('contractRequest', function ($h) use ($commercialId) {
                                $h->where('employee_id', $commercialId);
                            });
                        });
                    }
                })
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['contractRequestStreamAccount'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->where(function ($q) use ($commercialId) {
                    if ($commercialId != null) {
                        $q->whereHas('contractRequestStreamAccount', function ($k) use ($commercialId) {
                            $k->whereHas('contractRequest', function ($h) use ($commercialId) {
                                $h->where('employee_id', $commercialId);
                            });
                        });
                    }
                })
                ->paginate(10);
        }
        return $this->model->searchPaymentRequest($text)
            ->whereBetween('created_at', [$from, $to])
            ->with(['contractRequestStreamAccount'])
            ->orderby('created_at', 'desc')
            ->select($this->columns)
            ->where(function ($q) use ($commercialId) {
                if ($commercialId != null) {
                    $q->whereHas('contractRequestStreamAccount', function ($k) use ($commercialId) {
                        $k->whereHas('contractRequest', function ($h) use ($commercialId) {
                            $h->where('employee_id', $commercialId);
                        });
                    });
                }
            })
            ->paginate(10);
    }

    private function listPaymentRequests($commercialId)
    {
        return  $this->model->select($this->columns)
            ->with(['contractRequestStreamAccount'])
            ->orderby('created_at', 'desc')
            ->where(function ($q) use ($commercialId) {
                if ($commercialId != null) {
                    $q->whereHas('contractRequestStreamAccount', function ($k) use ($commercialId) {
                        $k->whereHas('contractRequest', function ($h) use ($commercialId) {
                            $h->where('employee_id', $commercialId);
                        });
                    });
                }
            })
            ->paginate(10);
    }

    public function getAprobedPaymentRequests(): Collection
    {
        return $this->model->with([
            'paymentRequestAdvances',
            'contractRequestStreamAccount', 'chaseTransfer'
        ])->where('is_aprobed', 1)
            ->where('payment_cut_id', null)
            ->whereNotNull('chase_transfer_id')
            ->get($this->columns);
    }

    public function deleteThumb(string $src): bool
    {
        return DB::table('payment_request_images')
            ->where('src', $src)
            ->delete();
    }

    public function sendNewPaymentRequestEmailNotificationToAdmin()
    {
        Mail::to(['email' => 'carlosq.syc@gmail.com'])->cc([
            'contabilidad@sycgroup.co',
            'aux.contable@sycgroup.co',
            'sycgroupsas@gmail.com'
        ])->queue(new SendNewPaymentRequestEmailNotificationToAdmin($this->findPaymentRequestById($this->model->id)));
    }

    public function sendPaymentRequestApprovattionNotificationToCustomer()
    {
        $payment_request = $this->findPaymentRequestById($this->model->id);
        $customerEmail   = $payment_request->contractRequestStreamAccount->contractRequest->customer->email;

        Mail::to(['email' => $customerEmail])->queue(new SendPaymenRequestApprovationNotificationToCustomer($payment_request));
    }

    public function getCustomerPaymentRequests($stream_accounts_ids)
    {
        $payment_requests_ids = $this->model
            ->whereIn('contract_request_stream_account_id', $stream_accounts_ids)
            ->get(['id']);

        $ids_array = [];
        foreach ($payment_requests_ids as $value) {
            array_push($ids_array, $value->id);
        }

        return $ids_array;
    }

    public function listPaymentRequestsByCustomerId($payment_requests_ids)
    {
        return  $this->model
            ->whereIn('id', $payment_requests_ids)
            ->orderby('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }

    public function searchPaymentRequestsByCustomerId(string $text = null, $payment_requests_ids, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPaymentRequestsByCustomerId($payment_requests_ids);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentRequest($text)
                ->whereIn('id', $payment_requests_ids)
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->whereIn('id', $payment_requests_ids)
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        return $this->model->searchPaymentRequest($text)
            ->whereIn('id', $payment_requests_ids)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }

    public function findPendingPayments(array $chaseTransfersIds): Collection
    {
        return $this->model
            ->with(['contractRequestStreamAccount'])
            ->whereIn('chase_transfer_id', $chaseTransfersIds)
            ->whereNull('payment_cut_id')
            ->get($this->columns);
    }

    public function findPendingPaymentRequests(): Collection
    {
        return $this->model->with([
            'paymentRequestStatus',
            'contractRequestStreamAccount',
            'customerBankAccount',
        ])
            ->whereNull('chase_transfer_id')
            ->whereNull('payment_cut_id')
            ->where('payment_request_status_id', '!=', 9)
            ->orderBy('created_at', 'desc')
            ->get($this->columns);
    }
}
