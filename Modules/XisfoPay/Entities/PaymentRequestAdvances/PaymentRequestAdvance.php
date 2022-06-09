<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvances;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\PaymentRequestAdvanceImage;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\PaymentRequestStatus;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentRequestAdvance extends Model
{
    use SearchableTrait;
    protected $table = 'payment_request_advances';

    protected $fillable = [
        'payment_request_id',
        'value',
        'trm_tokens',
        'payment_request_status_id',
        'is_aprobed'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'payment_request_statuses.name' => 10
        ],
        'joins' => [
            'payment_request_statuses'  => ['payment_request_statuses.id', 'payment_request_advances.payment_request_status_id']
        ]
    ];

    public function searchPaymentRequestAdvance($term)
    {
        return self::search($term, null, true, true);
    }

    public function paymentRequest(): BelongsTo
    {
        return $this->belongsTo(PaymentRequest::class)->with(['contractRequestStreamAccount'])
            ->select(['id', 'payment_request_status_id', 'usd_amount', 'grand_total', 'contract_request_stream_account_id', 'created_at', 'is_aprobed']);
    }

    public function paymentRequestStatus(): BelongsTo
    {
        return $this->belongsTo(PaymentRequestStatus::class)
            ->select(['id', 'name', 'color', 'is_active']);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PaymentRequestAdvanceImage::class)
            ->select(['id', 'payment_request_advance_id', 'src']);
    }
}
