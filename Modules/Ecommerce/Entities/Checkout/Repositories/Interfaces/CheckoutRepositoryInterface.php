<?php

namespace Modules\Ecommerce\Entities\Checkout\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Checkout\Checkout;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Products\Product;

interface CheckoutRepositoryInterface
{
    public function updateOrCreateCheckout($data);

    public function listCheckouts(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection;

    public function findCheckoutById(int $id): Checkout;

    public function associateProduct(Product $product, int $quantity = 1, array $data = []);

    public function getLastCheckout(): Checkout;

    public function removeCheckout($checkout): bool;

    public function buildCheckoutDetails(Collection $items);

    public function buildCheckoutItems(array $data): Order;

    public function buildPayUCheckoutItems(array $data): Order;

    public function getCreditCards($array);

    public function getBalotoEfecty($array);

    public function getPse($array);

    public function searchCheckouts(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCheckouts(string $text = null,  $from = null, $to = null);

    public function list(int $totalView): Collection;
}
