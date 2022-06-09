<?php

namespace Modules\Companies\Entities\Shifts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Goals\Goal;
use Nicolaslopezj\Searchable\SearchableTrait;

class Shift extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table    = 'shifts';
    protected $fillable = ['name', 'starts', 'end', 'goal_id'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];
    protected $hidden   = [];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'shifts.id'   => 10,
            'shifts.name' => 10,
        ]
    ];

    public function searchShift($term)
    {
        return self::search($term, null, true, true);
    }

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }
}
