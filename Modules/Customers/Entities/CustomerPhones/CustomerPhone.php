<?php

namespace Modules\Customers\Entities\CustomerPhones;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerReferences\CustomerReference;

class CustomerPhone extends Model
{
    use SoftDeletes;
    protected $table = 'customer_phones';

    public $fillable = [
        'phone_type',
        'phone',
        'prefix',
        'customer_id',
        'default_phone'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'customer_id',
        'status',
        'deleted_at'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->with('scholarity')
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }

    public function customerReferences(): BelongsTo
    {
        return $this->hasMany(CustomerReference::class)
            ->select(['id', 'customer_id', 'customer_phone_id', 'relationship_id', 'is_active', 'created_at']);
    }
}
