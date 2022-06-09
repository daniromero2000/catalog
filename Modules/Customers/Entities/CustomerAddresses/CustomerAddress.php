<?php

namespace Modules\Customers\Entities\CustomerAddresses;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\Housings\Housing;
use Modules\Generals\Entities\Stratums\Stratum;

class CustomerAddress extends Model
{
    use SoftDeletes;
    protected $table = 'customer_addresses';

    public $fillable = [
        'customer_id',
        'housing_id',
        'time_living',
        'stratum_id',
        'customer_address',
        'city_id',
        'default_address'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'customer_id',
        'default_address',
        'deleted_at'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)->with(['province'])
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }

    public function housing(): BelongsTo
    {
        return $this->belongsTo(Housing::class)->select(['id', 'housing']);
    }

    public function stratum(): BelongsTo
    {
        return $this->belongsTo(Stratum::class)->select(['id', 'stratum', 'description']);
    }
}
