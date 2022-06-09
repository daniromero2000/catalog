<?php

namespace Modules\Generals\Entities\VehicleTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerVehicles\CustomerVehicle;
use Modules\Generals\Database\factories\VehicleTypeFactory;

class VehicleType extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'vehicle_types';
    protected $fillable = ['vehicle_type'];
    protected $hidden   = ['customer_vehicle_type_id'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return VehicleTypeFactory::new();
    }

    public function customerVehicles(): HasMany
    {
        return $this->hasMany(CustomerVehicle::class);
    }
}
