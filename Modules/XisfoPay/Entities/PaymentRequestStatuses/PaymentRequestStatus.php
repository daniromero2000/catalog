<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\XisfoPay\Database\factories\PaymentRequestStatusFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentRequestStatus extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'payment_request_statuses';

    protected $fillable = [
        'name',
        'color',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'payment_request_statuses.name'  => 10,
        ]
    ];

    public function searchPaymentRequestStatus($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return PaymentRequestStatusFactory::new();
    }
}
