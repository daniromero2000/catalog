<?php

namespace Modules\Ecommerce\Entities\Couriers\Repositories;

use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Ecommerce\Entities\Couriers\Exceptions\CourierInvalidArgumentException;
use Modules\Ecommerce\Entities\Couriers\Exceptions\CourierNotFoundException;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class CourierRepository implements CourierRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'description',
        'url',
        'is_free',
        'cost',
        'logo'
    ];

    public function __construct(Courier $courier)
    {
        $this->model = $courier;
    }

    public function createCourier(array $data): Courier
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CourierInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCourier(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new CourierInvalidArgumentException($e->getMessage());
        }
    }

    public function findCourierByProvince(int $province_id)
    {
        try {
            return $this->model->whereHas('provinces', function ($q) use ($province_id) {
                $q->where('province_id',  $province_id);
            })->first();
        } catch (ModelNotFoundException $e) {
            throw new CourierNotFoundException($e->getMessage());
        }
    }

    public function findCourierById(int $id): Courier
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CourierNotFoundException($e->getMessage());
        }
    }

    public function listCouriers(string $order = 'id', string $sort = 'desc'): Collection
    {
        return $this->model->all($this->columns, $order, $sort);
    }

    public function deleteCourier()
    {
        return $this->model->delete();
    }

    public function getCourier()
    {
        if (auth()->check()) {
            $courier = "";
            if (!empty(auth()->user()->customerAddresses->toArray())) {
                $provinceId = auth()->user()->customerAddresses[0]->city->province->id;
                $courier  =  $this->findCourierByProvince($provinceId, $this->columns);
            }
            if ($courier == null) {
                $courier  = $this->findCourierById(request()->session()->get('courierId', 3), $this->columns);
            }
        } else {
            $courier  = $this->findCourierById(request()->session()->get('courierId', 2), $this->columns);
        }

        return $courier;
    }
}
