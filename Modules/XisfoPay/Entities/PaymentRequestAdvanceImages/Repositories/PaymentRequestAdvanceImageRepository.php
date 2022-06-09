<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\PaymentRequestAdvanceImage;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Exceptions\PaymentRequestAdvanceImageNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Exceptions\CreatePaymentRequestAdvanceImageErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Exceptions\DeletingPaymentRequestAdvanceImageErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Exceptions\UpdatePaymentRequestAdvanceImageErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Repositories\Interfaces\PaymentRequestAdvanceImageRepositoryInterface;

class PaymentRequestAdvanceImageRepository implements PaymentRequestAdvanceImageRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'payment_request_advance_id',
        'src'
    ];

    public function __construct(PaymentRequestAdvanceImage $paymentRequestImage)
    {
        $this->model = $paymentRequestImage;
    }

    public function createPaymentRequestAdvanceImage(array $data): PaymentRequestAdvanceImage
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentRequestAdvanceImageErrorException($e->getMessage());
        }
    }

    public function updatePaymentRequestAdvanceImage(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePaymentRequestAdvanceImageErrorException($e->getMessage());
        }
    }

    public function findPaymentRequestAdvanceImageById(int $id): PaymentRequestAdvanceImage
    {
        try {
            return $this->model->with([
                'paymentRequest'
            ])->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentRequestAdvanceImageNotFoundException($e->getMessage());
        }
    }

    public function deletePaymentRequestAdvanceImage(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPaymentRequestAdvanceImageErrorException($e->getMessage());
        }
    }
}
