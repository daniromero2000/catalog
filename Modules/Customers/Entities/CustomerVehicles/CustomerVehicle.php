<?php

namespace Modules\Customers\Entities\CustomerVehicles;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\VehicleBrands\VehicleBrand;
use Modules\Generals\Entities\VehicleTypes\VehicleType;

class CustomerVehicle extends Model
{
    use SoftDeletes;
    protected $table = 'customer_vehicles';

    public $fillable = [
        'vehicle_type_id',
        'vehicle_brand_id',
        'customer_id',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'vehicle_type_id',
        'vehicle_brand_id',
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
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class)->select(['id', 'vehicle_type']);
    }

    public function vehicleBrand(): BelongsTo
    {
        return $this->belongsTo(VehicleBrand::class)->select(['id', 'vehicle_brand']);
    }
}
