<?php

namespace Modules\Customers\Entities\CustomerIdentities;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\IdentityTypes\IdentityType;

class CustomerIdentity extends Model
{
    use SoftDeletes;
    protected $table = 'customer_identities';

    public $fillable = [
        'identity_type_id',
        'identity_number',
        'expedition_date',
        'city_id',
        'customer_id',
        'is_active',
        'is_aprobed',
        'file'
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
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday',
                'scholarity_id', 'status', 'customer_status_id',
                'customer_channel_id', 'city_id', 'data_politics', 'genre_id',
                'customer_channel_id', 'civil_status_id', 'scholarity_id',
                'email', 'created_at'
            ]);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }

    public function identityType(): BelongsTo
    {
        return $this->belongsTo(IdentityType::class)
            ->select(['id', 'identity_type', 'initials']);
    }
}
