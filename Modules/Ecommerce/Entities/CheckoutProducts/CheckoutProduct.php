<?php

namespace Modules\Ecommerce\Entities\CheckoutProducts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckoutProduct extends Model
{
    use SoftDeletes;
    protected $table = 'checkout_product';

    protected $fillable = [
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];
}
