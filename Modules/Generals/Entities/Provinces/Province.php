<?php

namespace Modules\Generals\Entities\Provinces;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\Countries\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Database\factories\ProvinceFactory;

class Province extends Model
{
    use SoftDeletes, HasFactory;
    protected $table    = 'provinces';
    protected $fillable = ['name', 'country_id'];
    protected $hidden   = [];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return ProvinceFactory::new();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)
            ->select(['id', 'name', 'iso', 'iso3', 'numcode', 'phonecode', 'is_active']);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class)->orderBy('city', 'asc')
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }
}
