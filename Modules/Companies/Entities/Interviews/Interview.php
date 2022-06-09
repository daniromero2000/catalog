<?php

namespace Modules\Companies\Entities\Interviews;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Modules\Companies\Entities\InterviewCommentaries\InterviewCommentary;
use Modules\Companies\Entities\InterviewStatuses\InterviewStatus;
use Nicolaslopezj\Searchable\SearchableTrait;

class Interview extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'interviews';

    protected $fillable = [
        'name',
        'last_name',
        'identification_number',
        'birthday',
        'phone',
        'email',
        'address',
        'calification',
        'employee_position_id',
        'english_knowledge',
        'interview_status_id',
        'picture'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'interviews.name'                  => 10,
            'interviews.email'                 => 5,
            'interviews.last_name'             => 5,
            'interviews.identification_number' => 5,
        ]
    ];

    public function searchInterview($term)
    {
        return self::search($term, null, true, true);
    }

    public function interviewStatus(): BelongsTo
    {
        return $this->belongsTo(InterviewStatus::class);
    }

    public function employeePosition(): BelongsTo
    {
        return $this->belongsTo(EmployeePosition::class);
    }

    public function interviewCommentaries(): HasMany
    {
        return $this->hasMany(InterviewCommentary::class);
    }
}
