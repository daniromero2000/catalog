<?php

namespace Modules\XisfoPay\Entities\PaymentRequestImages\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\XisfoPay\Entities\PaymentRequestImages\PaymentRequestImage;
use Modules\XisfoPay\Entities\PaymentRequestImages\Exceptions\PaymentRequestImageNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequestImages\Exceptions\CreatePaymentRequestImageErrorException;
use Modules\XisfoPay\Entities\PaymentRequestImages\Exceptions\DeletingPaymentRequestImageErrorException;
use Modules\XisfoPay\Entities\PaymentRequestImages\Exceptions\UpdatePaymentRequestImageErrorException;
use Modules\XisfoPay\Entities\PaymentRequestImages\Repositories\Interfaces\PaymentRequestImageRepositoryInterface;

class PaymentRequestImageRepository implements PaymentRequestImageRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'payment_request_id',
        'src'
    ];

    public function __construct(PaymentRequestImage $paymentRequestImage)
    {
        $this->model = $paymentRequestImage;
    }

    public function createPaymentRequestImage(array $data): PaymentRequestImage
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentRequestImageErrorException($e->getMessage());
        }
    }

    public function updatePaymentRequestImage(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePaymentRequestImageErrorException($e->getMessage());
        }
    }

    public function findPaymentRequestImageById(int $id): PaymentRequestImage
    {
        try {
            return $this->model->with([
                'paymentRequest'
            ])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentRequestImageNotFoundException($e->getMessage());
        }
    }

    public function deletePaymentRequestImage(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPaymentRequestImageErrorException($e->getMessage());
        }
    }

    public function savePaymentRequestImages($id, Collection $collection, $client)
    {
        $collection->each(function (UploadedFile $file) use ($id, $client) {
            $filename            = $this->storeFile($file, 'payment_requests/' . $client);
            $paymentRequestImage = new PaymentRequestImage([
                'payment_request_id' => $id,
                'src'                => $filename
            ]);
            $paymentRequestImage->save();
        });
    }
}
