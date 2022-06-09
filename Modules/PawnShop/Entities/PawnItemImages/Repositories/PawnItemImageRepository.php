<?php

namespace Modules\PawnShop\Entities\PawnItemImages\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\XisfoPay\Entities\PawnItemImages\PawnItemImage;
use Modules\XisfoPay\Entities\PawnItemImages\Exceptions\PawnItemImageNotFoundException;
use Modules\XisfoPay\Entities\PawnItemImages\Exceptions\CreatePawnItemImageErrorException;
use Modules\XisfoPay\Entities\PawnItemImages\Exceptions\DeletingPawnItemImageErrorException;
use Modules\XisfoPay\Entities\PawnItemImages\Exceptions\UpdatePawnItemImageErrorException;
use Modules\XisfoPay\Entities\PawnItemImages\Repositories\Interfaces\PawnItemImageRepositoryInterface;

class PawnItemImageRepository implements PawnItemImageRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'payment_request_id',
        'src'
    ];

    public function __construct(PawnItemImage $paymentRequestImage)
    {
        $this->model = $paymentRequestImage;
    }

    public function createPawnItemImage(array $data): PawnItemImage
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePawnItemImageErrorException($e->getMessage());
        }
    }

    public function updatePawnItemImage(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdatePawnItemImageErrorException($e->getMessage());
        }
    }

    public function findPawnItemImageById(int $id): PawnItemImage
    {
        try {
            return $this->model->with([
                'PawnItem'
            ])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PawnItemImageNotFoundException($e->getMessage());
        }
    }

    public function deletePawnItemImage(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingPawnItemImageErrorException($e->getMessage());
        }
    }
}
