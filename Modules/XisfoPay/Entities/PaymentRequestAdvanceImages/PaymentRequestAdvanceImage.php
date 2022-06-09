<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvanceImages;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentRequestAdvanceImage extends Model
{
    use SearchableTrait;
    protected $table = 'payment_request_advance_images';
    public $timestamps = false;

    protected $fillable = [
        'payment_request_advance_id',
        'src'
    ];

    protected $hidden = [
        'id'
    ];

    protected $guarded = [
        'id'
    ];
}
