<?php

namespace Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces;

use Illuminate\Support\Collection;

use Modules\Ecommerce\Entities\OrderShippings\OrderShipping;

interface OrderShippingRepositoryInterface
{
    public function createOrderShipping(array $data): OrderShipping;

    public function listOrderShippings(int $totalView): Collection;

    public function findOrderShipment(int $order_id): OrderShipping;

    public function findShipmentItems(int $shipment_id): Collection;

    public function searchShipping(string $text): Collection;

    public function searchOrderShipments(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countOrderShipments(string $text = null,  $from = null, $to = null);

    public function list(int $totalView): Collection;
}
