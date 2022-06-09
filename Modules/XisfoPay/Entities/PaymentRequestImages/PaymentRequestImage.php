<?php

namespace Modules\XisfoPay\Entities\PaymentRequestImages;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentRequestImage extends Model
{
    use SearchableTrait;
    protected $table = 'payment_request_images';
    public $timestamps = false;

    protected $fillable = [
        'payment_request_id',
        'src'
    ];

    protected $hidden = [
        'id'
    ];

    protected $guarded = [
        'id'
    ];
}
