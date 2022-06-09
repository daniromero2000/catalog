<?php

namespace Modules\Ecommerce\Entities\OrderStatuses\Repositories\Interfaces;

use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Illuminate\Support\Collection;

interface OrderStatusRepositoryInterface
{
    public function createOrderStatus(array $orderStatusData): OrderStatus;

    public function updateOrderStatus(array $data): bool;

    public function findOrderStatusById(int $id): OrderStatus;

    public function listOrderStatuses();

    public function deleteOrderStatus(): bool;

    public function findOrders(): Collection;

    public function findByName(string $name);
}
