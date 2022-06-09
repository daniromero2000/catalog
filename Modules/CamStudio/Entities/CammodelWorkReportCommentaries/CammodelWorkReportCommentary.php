<?php

namespace Modules\CamStudio\Entities\CammodelWorkReportCommentaries;

use Illuminate\Database\Eloquent\Model;

class CammodelWorkReportCommentary extends Model
{
    protected $table = 'cammodel_work_report_commentaries';

    public $fillable = [
        'commentary',
        'user',
        'cammodel_work_report_id',
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
