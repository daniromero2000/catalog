<?php

namespace Modules\CamStudio\Entities\CamstudioReportCommentaries;

use Illuminate\Database\Eloquent\Model;

class CamstudioReportCommentary extends Model
{
    protected $table = 'camstudio_report_commentaries';

    public $fillable = [
        'commentary',
        'user',
        'period_type',
        'subsidiary_id',
        'created_at'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
        'status'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'status',
        'user'
    ];

    protected $dates  = ['created_at', 'updated_at'];
}
