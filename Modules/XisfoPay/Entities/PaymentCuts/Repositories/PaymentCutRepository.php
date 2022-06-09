<?php

namespace Modules\XisfoPay\Entities\PaymentCuts\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;
use Modules\XisfoPay\Entities\PaymentCuts\Exceptions\PaymentCutNotFoundException;
use Modules\XisfoPay\Entities\PaymentCuts\Exceptions\CreatePaymentCutErrorException;
use Modules\XisfoPay\Entities\PaymentCuts\Exceptions\DeletingPaymentCutErrorException;
use Modules\XisfoPay\Entities\PaymentCuts\Exceptions\UpdatePaymentCutErrorException;
use Modules\XisfoPay\Entities\PaymentCuts\Repositories\Interfaces\PaymentCutRepositoryInterface;
use Modules\XisfoPay\Mail\PaymentCuts\SendNewPaymentCutEmailNotificationToAdmin;

class PaymentCutRepository implements PaymentCutRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'chase_transfer_trm_id',
        'chase_transfer_trm',
        'payment_cut_bank',
        'is_aprobed',
        'user_approves',
        'created_at'
    ];

    public function __construct(PaymentCut $paymentCut)
    {
        $this->model = $paymentCut;
    }

    public function createPaymentCut(array $data): PaymentCut
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentCutErrorException($e->getMessage());
        }
    }

    public function updatePaymentCut(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePaymentCutErrorException($e->getMessage());
        }
    }

    public function findPaymentCutById(int $id): PaymentCut
    {
        try {
            return $this->model->with(['paymentRequests'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentCutNotFoundException($e->getMessage());
        }
    }

    public function listPaymentCuts($totalView): Collection
    {
        return  $this->model->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deletePaymentCut(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPaymentCutErrorException($e->getMessage());
        }
    }

    public function searchPaymentCut(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listPaymentCuts($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchPaymentCut($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchPaymentCut($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('percentage', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function countPaymentCut(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchPaymentCut($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchPaymentCut($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function sendNewPaymentCutEmailNotificationToAdmin()
    {
        Mail::to(['email' => 'carlosq.syc@gmail.com'])->cc(['contabilidad@sycgroup.co'])
            ->queue(new SendNewPaymentCutEmailNotificationToAdmin($this->findPaymentCutById($this->model->id)));
    }
}
