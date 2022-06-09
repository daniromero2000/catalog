<?php

namespace Modules\Companies\Entities\InterviewStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\InterviewStatusFactory;

class InterviewStatus extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'interview_statuses';

    protected $fillable = [
        'name',
        'color'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'interview_statuses.name' => 10,
        ]
    ];

    protected static function newFactory()
    {
        return InterviewStatusFactory::new();
    }

    public function searchInterviewStatuses($term)
    {
        return self::search($term, null, true, true);
    }
}
