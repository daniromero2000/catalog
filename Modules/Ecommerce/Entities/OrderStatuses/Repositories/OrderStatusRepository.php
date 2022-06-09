<?php

namespace Modules\Ecommerce\Entities\OrderStatuses\Repositories;

use Modules\Ecommerce\Entities\OrderStatuses\Exceptions\OrderStatusInvalidArgumentException;
use Modules\Ecommerce\Entities\OrderStatuses\Exceptions\OrderStatusNotFoundException;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class OrderStatusRepository implements OrderStatusRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'color', 'is_active'];

    public function __construct(OrderStatus $orderStatus)
    {
        $this->model = $orderStatus;
    }

    public function createOrderStatus(array $data): OrderStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new OrderStatusInvalidArgumentException($e->getMessage());
        }
    }

    public function updateOrderStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new OrderStatusInvalidArgumentException($e->getMessage());
        }
    }

    public function findOrderStatusById(int $id): OrderStatus
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderStatusNotFoundException($e->getMessage());
        }
    }

    public function listOrderStatuses()
    {
        return $this->model->all($this->columns);
    }

    public function deleteOrderStatus(): bool
    {
        return $this->model->delete();
    }

    public function findOrders(): Collection
    {
        return $this->model->orders()->get();
    }

    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
