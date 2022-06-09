<?php

namespace Modules\Ecommerce\Entities\OrderShippings\Repositories;

use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\Brands\Exceptions\CreateBrandErrorException;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\OrderShippings\OrderShipping;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingRepositoryInterface;
use Modules\Ecommerce\Entities\OrderShippings\Exceptions\CreateOrderShippingErrorException;
use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces\OrderShippingItemInterface;
use Modules\Ecommerce\Entities\OrderShippingItems\Exceptions\CreateOrderShippingItemErrorException;
use Illuminate\Support\Collection;

class OrderShippingRepository implements OrderShippingRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'order_id',
        'courier_id',
        'company_id',
        'total_qty',
        'total_weight',
        'track_number'
    ];

    public function __construct(OrderShipping $orderShipping)
    {
        $this->model = $orderShipping;
    }

    public function createOrderShipping(array $data): OrderShipping
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateOrderShippingErrorException($e->getMessage());
        }
    }

    public function listOrderShippings(int $totalView): Collection
    {
        return $this->model->with(['courier'])->skip($totalView)->take(10)->get($this->columns);
    }

    public function findOrderShipment(int $order_id): OrderShipping
    {
        try {
            return $this->model->with(['shipmentItems', 'order'])->findOrFail($order_id);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findShipmentItems(int $shipment_id): Collection
    {
        return $this->model->searchShipmentItems($shipment_id)->get();
    }


    public function searchShipping(string $text): Collection
    {

        if (!empty($text)) {
            return $this->model->searchShipping($text);
        } else {
            return $this->listOrderShippings(0);
        }
    }

    public function searchOrderShipments(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->list($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model
                ->searchOrderShipments($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchOrderShipments($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countOrderShipments(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchOrderShipments($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchOrderShipments($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function list(int $totalView): Collection
    {
        return $this->model->orderBy('created_at', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }
}
