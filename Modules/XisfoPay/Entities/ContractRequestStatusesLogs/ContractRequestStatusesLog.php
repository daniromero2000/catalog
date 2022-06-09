<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatusesLogs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;

class ContractRequestStatusesLog extends Model
{
    protected $table = 'contract_request_statuses_logs';

    protected $fillable = [
        'contract_request_id',
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

    public function contractRequest(): BelongsTo
    {
        return $this->belongsTo(ContractRequest::class)
            ->select(['id', 'contract_request_status_id', 'customer_id', 'client_identifier', 'contract_id', 'is_signed', 'created_at']);
    }
}
