<?php

namespace Modules\Companies\Entities\InterviewCommentaries;

use Illuminate\Database\Eloquent\Model;

class InterviewCommentary extends Model
{

    protected $table = 'interview_commentaries';

    protected $fillable = [
        'commentary',
        'user',
        'customer_notified',
        'interview_id'
    ];

    protected $hidden   = ['created_at', 'updated_at'];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at'
    ];

    protected $dates  = ['created_at', 'updated_at'];
}
