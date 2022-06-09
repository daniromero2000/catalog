<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\PaymentRequestStatus;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Exceptions\PaymentRequestStatusNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Exceptions\CreatePaymentRequestStatusErrorException;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Exceptions\DeletingPaymentRequestStatusErrorException;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Exceptions\UpdatePaymentRequestStatusErrorException;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\Interfaces\PaymentRequestStatusRepositoryInterface;

class PaymentRequestStatusRepository implements PaymentRequestStatusRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'color',
        'is_active',
        'created_at'
    ];

    public function __construct(PaymentRequestStatus $contractRequestStatus)
    {
        $this->model = $contractRequestStatus;
    }

    public function createPaymentRequestStatus(array $data): PaymentRequestStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentRequestStatusErrorException($e->getMessage());
        }
    }

    public function updatePaymentRequestStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePaymentRequestStatusErrorException($e->getMessage());
        }
    }

    public function findPaymentRequestStatusById(int $id): PaymentRequestStatus
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentRequestStatusNotFoundException($e->getMessage());
        }
    }

    public function listPaymentRequestStatuses($totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function deletePaymentRequestStatus(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPaymentRequestStatusErrorException($e->getMessage());
        }
    }

    public function searchPaymentRequestStatus(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPaymentRequestStatuses($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentRequestStatus($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchPaymentRequestStatus($text)
            ->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function countPaymentRequestStatus(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentRequestStatus($text)->count();
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])->count();
        }

        return  $this->model->searchPaymentRequestStatus($text)
            ->whereBetween('created_at', [$from, $to])->count();
    }

    public function getAllPaymentRequestStatusesNames(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get($this->columns);
    }
}
