<?php

namespace Modules\CamStudio\Entities\CammodelStreamingIncomes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\CamStudio\Entities\CammodelStreamAccounts\CammodelStreamAccount;
use Modules\CamStudio\Entities\CammodelWorkReports\CammodelWorkReport;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelStreamingIncome extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'cammodel_streaming_incomes';

    protected $fillable = [
        'cammodel_work_report_id',
        'cammodel_stream_account_id',
        'tokens',
        'dollars',
        'accumulated_tokens',
        'accumulated_dollars',
        'user_approves',
        'cammodel_payroll_id',
        'created_at'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'cammodel_streaming_incomes.id' => 10,
            'cammodels.nickname'            => 10,
            'streamings.streaming'          => 10
        ],
        'joins'   => [
            'cammodel_stream_accounts' => ['cammodel_stream_accounts.id', 'cammodel_streaming_incomes.cammodel_stream_account_id'],
            'cammodels'                => ['cammodels.id', 'cammodel_stream_accounts.cammodel_id'],
            'streamings'               => ['streamings.id', 'cammodel_stream_accounts.streaming_id'],
        ]
    ];

    public function searchCammodelStreamingIncome($term)
    {
        return self::search($term, null, true, true);
    }

    public function cammodelPayroll(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class);
    }

    public function cammodelStreamAccount(): BelongsTo
    {
        return $this->belongsTo(CammodelStreamAccount::class)
            ->with('streaming', 'cammodelWithEmployee')
            ->select(['id', 'streaming_id', 'cammodel_id', 'profile', 'is_active']);
    }

    public function cammodelWorkReport(): BelongsTo
    {
        return $this->belongsTo(CammodelWorkReport::class)
            ->with(['shift', 'manager', 'room', 'subsidiary'])
            ->select(['id', 'manager_id', 'shift_id', 'room_id', 'subsidiary_id']);
    }
}
