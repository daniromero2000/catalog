<?php

namespace Modules\CamStudio\Entities\Rooms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Nicolaslopezj\Searchable\SearchableTrait;

class Room extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'subsidiary_id',
        'photo'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'rooms.id'          => 10,
            'rooms.name'        => 10,
            'subsidiaries.name' => 10
        ],
        'joins' => [
            'subsidiaries' => ['subsidiaries.id', 'rooms.subsidiary_id']
        ]
    ];

    public function searchRoom($term)
    {
        return self::search($term, null, true, true);
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class)->select(['id', 'name']);
    }
}
