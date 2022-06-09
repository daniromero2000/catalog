<?php

namespace Modules\Ecommerce\Entities\CourierProvinces;

use Illuminate\Database\Eloquent\Model;

class CourierProvince extends Model
{
    protected $table = 'courier_province';

    protected $fillable = [
        'quantity',
        'price',
        'sale_price',
        'default'
    ];

    protected $hidden = [
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = [

        'created_at',
        'updated_at'
    ];
}
