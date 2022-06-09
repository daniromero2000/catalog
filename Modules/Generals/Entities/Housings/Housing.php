<?php

namespace Modules\Generals\Entities\Housings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Generals\Database\factories\HousingFactory;

class Housing extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'housings';
    protected $fillable = ['housing'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return HousingFactory::new();
    }

    public function customerAddresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class)
            ->select([
                'id', 'housing_id', 'customer_address', 'time_living',
                'stratum_id', 'city_id', 'customer_id', 'postal_code',
                'comment', 'default_address'
            ]);
    }
}
