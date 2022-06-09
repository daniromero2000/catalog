<?php

namespace Modules\Pqrs\Entities\PqrCommentaries;

use Modules\Pqrs\Entities\Pqrs\pqr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PqrCommentary extends Model
{
    protected $table = 'pqr_commentaries';

    public $fillable = [
        'pqr_id',
        'commentary',
        'user'
    ];

    protected $hidden = [
        'updated_at',
        'pqr_id',
        'id'
    ];

    protected $dates  = ['created_at', 'updated_at'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'status'
    ];

    public function pqr(): BelongsTo
    {
        return $this->belongsTo(Pqr::class);
    }
}
