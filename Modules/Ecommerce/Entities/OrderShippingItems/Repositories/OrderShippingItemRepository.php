<?php

namespace Modules\Ecommerce\Entities\OrderShippingItems\Repositories;

use Modules\Ecommerce\Entities\Brands\Exceptions\CreateBrandErrorException;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces\OrderShippingItemInterface;
use Modules\Ecommerce\Entities\OrderShippingItems\Exceptions\CreateOrderShippingItemErrorException;
use Illuminate\Support\Collection;

class OrderShippingItemRepository implements OrderShippingItemInterface
{
    protected $model;
    private $columns = [
        'name',
        'description',
        'sku',
        'qty',
        'weight',
        'price',
        'shipment_id'
    ];

    public function __construct(OrderShippingItem $OrderShippingItem)
    {
        $this->model = $OrderShippingItem;
    }

    public function createOrderShippingItem(array $data): OrderShippingItem
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateOrderShippingItemErrorException($e->getMessage());
        }
    }

    public function listOrderShippingItems(int $totalView): Collection
    {
        return $this->model->get($this->columns);
    }

    public function findOrderShipmentItems(int $shipment_id): Collection
    {
        return $this->model->searchForShipmentItems($shipment_id)->get();
    }


}
