<?php

namespace Modules\Generals\Entities\Countries;

use Modules\Generals\Entities\Provinces\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Database\factories\CountryFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class Country extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table    = 'countries';
    protected $fillable = ['name', 'iso', 'iso3', 'numcode', 'phonecode', 'is_active'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];
    protected $hidden   = [];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'countries.name' => 10,
        ]
    ];

    protected static function newFactory()
    {
        return CountryFactory::new();
    }

    public function searchCountry($term)
    {
        return self::search($term, null, true, true);
    }

    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class)->orderBy('province', 'asc')
            ->select(['id', 'dane', 'province', 'country_id', 'is_active']);
    }
}
