<?php

namespace Modules\Customers\Entities\LeadStatusesLogs;

use Modules\Customers\Entities\Leads\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadStatusesLog extends Model
{
    protected $table  = 'lead_statuses_logs';

    protected $fillable = [
        'id',
        'lead_id',
        'status',
        'user'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];

    protected $hidden = [
        'updated_at',
        'relevance'
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class)
            ->select([
                'id', 'name', 'last_name', 'email', 'phone', 'data_politics', 'city_id',
                'customer_channel_id', 'lead_status_id', 'customer_id', 'created_at'
            ]);
    }
}
