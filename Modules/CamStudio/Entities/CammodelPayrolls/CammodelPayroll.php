<?php

namespace Modules\CamStudio\Entities\CammodelPayrolls;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\CammodelFines\CammodelFine;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\CammodelStreamingIncome;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelPayroll extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'cammodel_payrolls';

    protected $fillable = [
        'cammodel_id',
        'usd_cammodel',
        'bonus',
        'total_usd_cammodel',
        'usd_studio',
        'total_cop_cammodel',
        'trm',
        'user_approves',
        'from',
        'to'
    ];

    protected $hidden = [
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at',
        'from',
        'to'
    ];

    protected $searchable = [
        'columns' => [
            'cammodels.nickname' => 10
        ],
        'joins' => [
            'cammodels' => ['cammodels.id', 'cammodel_payrolls.cammodel_id'],
        ]
    ];

    public function searchCammodelPayroll($term)
    {
        return self::search($term, null, true, true);
    }

    public function cammodel(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class)->withTrashed()->select(['id', 'nickname']);
    }

    public function cammodelStreamingIncomes(): HasMany
    {
        return $this->hasMany(CammodelStreamingIncome::class)
            ->select([
                'cammodel_work_report_id', 'cammodel_stream_account_id', 'tokens',
                'dollars', 'accumulated_tokens', 'accumulated_dollars', 'user_approves',
                'cammodel_payroll_id', 'id', 'created_at'
            ]);
    }

    public function cammodelFines(): HasMany
    {
        return $this->hasMany(CammodelFine::class)
            ->select(['id',  'cammodel_id', 'foul_id', 'cammodel_payroll_id', 'is_aprobed', 'created_at']);
    }

    public function cammodelFinesForPayroll(): HasMany
    {
        return $this->hasMany(CammodelFine::class)->where('is_aprobed', 1)
            ->select(['id',  'cammodel_id', 'foul_id', 'cammodel_payroll_id', 'is_aprobed', 'created_at']);
    }
}
