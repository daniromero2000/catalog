<?php

namespace Modules\Ecommerce\Entities\OrderShippings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Support\Collection;

class OrderShipping extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'shipments';

    protected $fillable = [
        'order_id',
        'courier_id',
        'employee_id',
        'company_id',
        'subsidiary_id',
        'description',
        'total_qty',
        'total_weight',
        'track_number',
        'email_sent'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'shipments.order_id'     => 10,
            'shipments.track_number' => 10,
            'shipments.total_weight' => 5,
            'couriers.id'            => 10,
            'couriers.name'          => 10
        ],
        'joins' => [
            'couriers' => ['couriers.id', 'shipments.courier_id']
        ],
        'groupBy' => ['shipments.order_id']
    ];

    public function searchForShipment(string $order_id)
    {
        return self::search($order_id);
    }

    public function searchShipmentItems(string $shipment_id)
    {
        return self::search($shipment_id);
    }

    public function searchShipping(string $term): Collection
    {
        return self::search($term, null, true, true)->get();
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class)->select('id', 'name');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class)
            ->select('id', 'reference', 'courier_id', 'customer_id', 'address_id');
    }

    public function shipmentItems(): HasMany
    {
        return $this->hasMany(OrderShippingItem::class, 'shipment_id');
    }
}
