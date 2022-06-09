<?php

namespace Modules\Ecommerce\Entities\OrderCommentaries;

use Modules\Ecommerce\Entities\Orders\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderCommentary extends Model
{
    protected $table = 'order_commentaries';

    public $fillable = [
        'customer_id',
        'commentary',
        'user'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'status',
        'customer_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'status',
        'user'
    ];

    protected $dates  = ['created_at', 'updated_at'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class)
            ->select(
                ['id', 'reference', 'courier_id', 'customer_id', 'address_id', 'order_status_id', 'payment', 'discounts', 'sub_total', 'tax_amount', 'grand_total', 'created_at']
            );
    }
}
