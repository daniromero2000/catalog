<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatusesLogs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;

class PaymentRequestStatusesLog extends Model
{
    protected $table = 'payment_request_statuses_logs';

    protected $fillable = [
        'payment_request_id',
        'status',
        'user',
        'time_passed'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];

    public function paymentRequest(): BelongsTo
    {
        return $this->belongsTo(PaymentRequest::class)->with(['contractRequestStreamAccount'])
            ->select(['id', 'payment_request_status_id', 'contract_request_stream_account_id', 'created_at']);
    }
}
