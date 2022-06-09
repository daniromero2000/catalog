<?php

namespace Modules\Customers\Entities\CustomerCommentaries;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerCommentary extends Model
{
    protected $table = 'customer_commentaries';

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

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }
}
