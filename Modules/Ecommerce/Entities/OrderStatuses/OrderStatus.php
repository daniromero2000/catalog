<?php

namespace Modules\Ecommerce\Entities\OrderStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ecommerce\Entities\Orders\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Database\factories\OrderStatusFactory;

class OrderStatus extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'order_statuses';

    protected $fillable = [
        'name',
        'color'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return OrderStatusFactory::new();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)
            ->select(
                ['id', 'reference', 'courier_id', 'customer_id', 'address_id', 'order_status_id', 'payment', 'discounts', 'sub_total', 'tax_amount', 'grand_total', 'created_at']
            );
    }
}
