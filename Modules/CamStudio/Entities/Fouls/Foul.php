<?php

namespace Modules\CamStudio\Entities\Fouls;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Foul extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'fouls';

    protected $fillable = [
        'name',
        'description',
        'charge'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'fouls.id'   => 10,
            'fouls.name' => 10,
        ]
    ];

    public function searchFoul($term)
    {
        return self::search($term, null, true, true);
    }
}
