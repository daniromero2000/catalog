<?php

namespace Modules\Companies\Entities\Goals;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Goal extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'goals';

    protected $fillable = [
        'usd_goal',
        'bonus',
        'min_usd_goal',
        'description'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'goals.id'       => 10,
            'goals.usd_goal' => 10,
        ]
    ];

    public function searchGoal($term)
    {
        return self::search($term, null, true, true);
    }
}
