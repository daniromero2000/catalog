<?php

namespace Modules\Ecommerce\Entities\OrderPayments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\Orders\Order;

class OrderPayment extends Model
{
    use SoftDeletes;
    protected $table = 'order_payments';

    protected $fillable = [
        'name',
        'method',
        'description',
        'transaction_id',
        'transaction_order',
        'state',
        'order_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    public function order(): BelongsTo
    {
        return  $this->belongsTo(Order::class);
    }
}
