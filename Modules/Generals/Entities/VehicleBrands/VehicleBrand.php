<?php

namespace Modules\Generals\Entities\VehicleBrands;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerVehicles\CustomerVehicle;
use Modules\Generals\Database\factories\VehicleBrandFactory;

class VehicleBrand extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'vehicle_brands';
    protected $fillable = ['vehicle_brand'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return VehicleBrandFactory::new();
    }

    public function customerVehicles(): HasMany
    {
        return $this->hasMany(CustomerVehicle::class);
    }
}
