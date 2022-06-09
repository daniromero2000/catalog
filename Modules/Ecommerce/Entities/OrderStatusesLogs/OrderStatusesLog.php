<?php

namespace Modules\Ecommerce\Entities\OrderStatusesLogs;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ecommerce\Entities\Orders\Order;

class OrderStatusesLog extends Model
{
    protected $table = 'order_statuses_logs';

    protected $fillable = [
        'customer_id',
        'status',
        'employee_id',
        'time_passed'
    ];

    protected $hidden = [
        'id',
        'customer_id',
        'updated_at',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Order::class)
            ->select(
                ['id', 'reference', 'courier_id', 'customer_id', 'address_id', 'order_status_id', 'payment', 'discounts', 'sub_total', 'tax_amount', 'grand_total', 'created_at']
            );
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->select(
                ['id', 'name', 'last_name', 'email', 'birthday', 'avatar', 'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token']
            );
    }
}
