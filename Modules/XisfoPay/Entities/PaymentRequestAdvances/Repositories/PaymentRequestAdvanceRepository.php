<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\PaymentRequestAdvance;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\PaymentRequestAdvanceNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\CreatePaymentRequestAdvanceErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\DeletingPaymentRequestAdvanceErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\UpdatePaymentRequestAdvanceErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\Interfaces\PaymentRequestAdvanceRepositoryInterface;

class PaymentRequestAdvanceRepository implements PaymentRequestAdvanceRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'payment_request_id',
        'payment_request_status_id',
        'value',
        'trm_tokens',
        'is_aprobed',
        'transfer',
        'created_at'
    ];

    public function __construct(PaymentRequestAdvance $paymentRequestAdvance)
    {
        $this->model = $paymentRequestAdvance;
    }

    public function createPaymentRequestAdvance(array $data): PaymentRequestAdvance
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentRequestAdvanceErrorException($e->getMessage());
        }
    }

    public function updatePaymentRequestAdvance(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePaymentRequestAdvanceErrorException($e->getMessage());
        }
    }

    public function findPaymentRequestAdvanceById(int $id): PaymentRequestAdvance
    {
        try {
            return $this->model->with([
                'paymentRequest',
                'paymentRequestStatus',
            ])->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentRequestAdvanceNotFoundException($e->getMessage());
        }
    }

    public function deletePaymentRequestAdvance(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPaymentRequestAdvanceErrorException($e->getMessage());
        }
    }

    public function searchPaymentRequestAdvance(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPaymentRequestAdvances();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentRequestAdvance($text)
                ->with(['paymentRequest', 'paymentRequest', 'paymentRequestStatus'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['paymentRequest', 'paymentRequest', 'paymentRequestStatus'])
                ->orderby('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }
        return $this->model->searchPaymentRequestAdvance($text)
            ->whereBetween('created_at', [$from, $to])
            ->with(['paymentRequest', 'paymentRequest', 'paymentRequestStatus'])
            ->orderby('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }

    public function listPaymentRequestAdvances()
    {
        return  $this->model->select($this->columns)
            ->with(['paymentRequest', 'paymentRequest', 'paymentRequestStatus'])
            ->orderby('created_at', 'desc')
            ->paginate(10);
    }

    public function deleteThumb(string $src): bool
    {
        return DB::table('payment_request_advance_images')
            ->where('src', $src)
            ->delete();
    }

    public function listPaymentRequestAdvancesByCustomerId($payment_requests_advances_ids)
    {
        return  $this->model->with(['paymentRequest', 'paymentRequest', 'paymentRequestStatus'])
            ->whereIn('id', $payment_requests_advances_ids)
            ->orderBy('created_at', 'desc')->select($this->columns)
            ->paginate(10);
    }

    public function searchPaymentRequestAdvanceByCustomerId(string $text = null, $payment_requests_advances_ids, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPaymentRequestAdvancesByCustomerId($payment_requests_advances_ids);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentRequestAdvance($text)
                ->whereIn('id', $payment_requests_advances_ids)
                ->with(['paymentRequest', 'paymentRequest', 'paymentRequestStatus'])
                ->orderBy('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->whereIn('id', $payment_requests_advances_ids)
                ->with(['paymentRequest', 'paymentRequest', 'paymentRequestStatus'])
                ->orderBy('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }

        return $this->model->searchPaymentRequestAdvance($text)
            ->with(['paymentRequest', 'paymentRequest', 'paymentRequestStatus'])
            ->whereIn('id', $payment_requests_advances_ids)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->select($this->columns)->paginate(10);
    }

    public function getCustomerPaymentRequestsAdvances($payment_requests_ids)
    {
        $payment_requests_advances_ids = $this->model
            ->whereIn('payment_request_id', $payment_requests_ids)
            ->get(['id']);
        $ids_array = [];

        foreach ($payment_requests_advances_ids as $value) {
            array_push($ids_array, $value->id);
        }

        return $ids_array;
    }
}
