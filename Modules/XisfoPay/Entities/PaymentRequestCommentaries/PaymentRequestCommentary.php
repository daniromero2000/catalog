<?php

namespace Modules\XisfoPay\Entities\PaymentRequestCommentaries;

use Illuminate\Database\Eloquent\Model;

class PaymentRequestCommentary extends Model
{
    protected $table = 'payment_request_commentaries';

    protected $fillable = [
        'commentary',
        'user',
        'payment_request_id'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];
}
