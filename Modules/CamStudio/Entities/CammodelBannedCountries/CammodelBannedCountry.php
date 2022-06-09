<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\Generals\Entities\Countries\Country;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelBannedCountry extends Model
{
    use SearchableTrait;

    protected $table = 'cammodel_banned_countries';
    protected $fillable = [
        'country_id',
        'cammodel_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'countries.name'     => 10,
            'cammodels.nickname' => 10
        ],
        'joins' => [
            'cammodels' => ['cammodels.id', 'cammodel_banned_countries.cammodel_id'],
            'countries' => ['countries.id', 'cammodel_banned_countries.country_id'],
        ]
    ];

    public function searchCammodelBannedCountries($term)
    {
        return self::search($term, null, true, true);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)->select(['id', 'name']);
    }

    public function cammodel(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class)->withTrashed()
            ->with(['employee'])->select(['id', 'nickname', 'employee_id']);
    }
}
