<?php

namespace Modules\Generals\Entities\Stratums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Generals\Database\factories\StratumFactory;

class Stratum extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'stratums';
    protected $fillable = ['stratum', 'description'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return StratumFactory::new();
    }

    public function customerAddresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class)
            ->select([
                'id', 'housing_id', 'customer_address', 'time_living',
                'stratum_id', 'city_id', 'customer_id', 'postal_code', 'comment',
                'default_address'
            ]);
    }
}
