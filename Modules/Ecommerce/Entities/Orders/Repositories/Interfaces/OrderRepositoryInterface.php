<?php

namespace Modules\Ecommerce\Entities\Orders\Repositories\Interfaces;

use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function createOrder(array $data): Order;

    public function updateOrder(array $data): bool;

    public function findOrderById(int $id): Order;

    public function findOrderByReference(int $reference): Order;

    public function findOrderByCustomerId($id): Order;

    public function listOrders(int $totalView): Collection;

    public function findProducts(Order $order): Collection;

    public function associateProduct(Product $product, int $quantity = 1, array $data = []);

    public function searchOrder(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countOrder(string $text = null,  $from = null, $to = null);

    public function listOrderedProducts(): Collection;

    public function buildOrderDetails(Collection $items);

    public function getAddresses(): Collection;

    public function getCouriers(): Collection;

    public function removeOrder(): bool;
}
