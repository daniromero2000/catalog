<?php

namespace Modules\XisfoPay\Entities\ContractStatusesLogs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\XisfoPay\Entities\Contracts\Contract;

class ContractStatusesLog extends Model
{
    protected $table = 'contract_statuses_logs';

    protected $fillable = [
        'contract_id',
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

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class)
            ->select(['id', 'contract_status_id', 'is_signed', 'is_active', 'created_at']);
    }
}
