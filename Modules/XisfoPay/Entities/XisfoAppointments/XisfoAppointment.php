<?php

namespace Modules\XisfoPay\Entities\XisfoAppointments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Customers\Entities\Customers\Customer;
use Nicolaslopezj\Searchable\SearchableTrait;

class XisfoAppointment extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'xisfo_appointments';

    protected $fillable = [
        'customer_id',
        'employee_id',
        'start_time',
        'finish_time',
        'comments',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'xisfo_appointments.id'  => 10,
        ]
    ];

    public function searchXisfoAppointment($term)
    {
        return self::search($term, null, true, true);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
