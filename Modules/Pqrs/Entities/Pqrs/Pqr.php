<?php

namespace Modules\Pqrs\Entities\Pqrs;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Pqrs\Entities\PqrCommentaries\PqrCommentary;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Pqrs\Entities\PqrsStatusesLogs\PqrsStatusesLog;
use Modules\Pqrs\Entities\PqrStatuses\PqrStatus;
use Modules\Generals\Entities\Cities\City;

class Pqr extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $table = 'pqrs';

    protected $fillable = [
        'name',
        'cedula',
        'email',
        'pqr',
        'asunto',
        'mensaje',
        'city_id',
        'pqr_status_id',
        'lead',
        'phone',
        'data_politics'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'updated_at',
        'cedula',
        'email',
        'asunto',
        'mensaje',
        'status_id',
        'city_id',
        'data_politics',
        'city',
        'lead',
        'pqr_city',
        'relevance',
        'status'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    public function pqrsCommentaries(): HasMany
    {
        return $this->hasMany(PqrCommentary::class);
    }

    public function pqrsStatusesLog(): HasMany
    {
        return $this->hasMany(PqrsStatusesLog::class);
    }

    public function pqrStatus(): BelongsTo
    {
        return $this->belongsTo(PqrStatus::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }
}
