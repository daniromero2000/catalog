<?php

namespace Modules\CamStudio\Entities\CammodelFines;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\CamStudio\Entities\Fouls\Foul;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelFine extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'cammodel_fines';

    protected $fillable = [
        'cammodel_id',
        'foul_id',
        'cammodel_payroll_id',
        'is_aprobed'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'cammodel_fines.id'  => 10,
            'cammodels.nickname' => 10
        ],
        'joins' => [
            'cammodels' => ['cammodels.id', 'cammodel_fines.cammodel_id']
        ]
    ];

    public function searchCammodelFine($term)
    {
        return self::search($term, null, true, true);
    }

    public function cammodel(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class)->select(['id', 'nickname']);
    }

    public function foul(): BelongsTo
    {
        return $this->belongsTo(Foul::class)->select(['id', 'name', 'charge']);
    }
}
