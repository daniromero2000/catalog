<?php

namespace Modules\CamStudio\Entities\CammodelWorkReports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\CammodelStreamingIncome;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\CammodelWorkReportCommentary;
use Modules\CamStudio\Entities\Rooms\Room;
use Modules\Companies\Entities\Shifts\Shift;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelWorkReport extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'cammodel_work_reports';

    protected $fillable = [
        'cammodel_id',
        'room_id',
        'subsidiary_id',
        'cammodel_shift_id',
        'shift_id',
        'manager_id',
        'entry_time',
        'connection_time',
        'disconnection_time',
        'observations',
        'created_at',
        'updated_at'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'cammodels.nickname' => 10,
            'employees.name'     => 10
        ],
        'joins' => [
            'cammodels' => ['cammodels.id', 'cammodel_work_reports.cammodel_id'],
            'employees' => ['employees.id', 'cammodel_work_reports.manager_id']
        ]
    ];

    public function searchCammodelWorkReport($term)
    {
        return self::search($term, null, true, true);
    }

    public function cammodel(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class)
            ->with('cammodelStreamAccountsWithoutSkype', 'employeeName', 'tippers')
            ->select(['id', 'nickname', 'cover', 'employee_id']);
    }

    public function cammodelStreamingIncomes(): HasMany
    {
        return $this->hasMany(CammodelStreamingIncome::class)
            ->with(['cammodelStreamAccount'])
            ->select([
                'id', 'cammodel_work_report_id', 'cammodel_stream_account_id',
                'tokens', 'dollars', 'accumulated_tokens', 'accumulated_dollars',
                'user_approves', 'cammodel_payroll_id', 'created_at'
            ]);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class)->with('subsidiary')
            ->select(['id', 'name', 'subsidiary_id']);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class)->select(['id', 'name']);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->whereIn('employee_position_id', [7, 28])
            ->select(['id', 'name', 'last_name']);
    }

    public function inCharge(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id', 'id')
            ->select(['id', 'name', 'last_name']);
    }

    public function cammodelWorkReportCommentaries(): HasMany
    {
        return $this->hasMany(CammodelWorkReportCommentary::class)
            ->select(['id', 'commentary', 'cammodel_work_report_id', 'user']);
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class)->select(['id', 'name']);
    }
}
