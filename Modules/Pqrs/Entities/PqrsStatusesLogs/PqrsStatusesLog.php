<?php

namespace Modules\Pqrs\Entities\PqrsStatusesLogs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Pqrs\Entities\Pqrs\Pqr;

class PqrsStatusesLog extends Model
{
    protected $table = 'pqrs_statuses_logs';

    protected $fillable = [
        'pqr_id',
        'status',
        'user'
    ];

    protected $hidden = [
        'id',
        'pqr_id',
        'updated_at',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];

    public function pqr(): BelongsTo
    {
        return $this->belongsTo(Pqr::class);
    }
}
