<?php

namespace Modules\Companies\Entities\Kpis;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Shifts\Shift;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Nicolaslopezj\Searchable\SearchableTrait;

class Kpi extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'kpis';

    protected $fillable = [
        'subsidiary_id',
        'shift_id',
        'min_fortnight_goal',
        'is_active'
    ];

    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $hidden  = [];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'kpis.id'           => 10,
            'subsidiaries.name' => 10
        ],
        'joins' => [
            'subsidiaries' => ['subsidiaries.id', 'kpis.subsidiary_id']
        ]
    ];

    public function searchKpi($term)
    {
        return self::search($term, null, true, true);
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo((Shift::class));
    }
}
