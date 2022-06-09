<?php

namespace Modules\Companies\Entities\Subsidiaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Companies\Entities\Departments\Department;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Generals\Entities\Cities\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Companies\Database\factories\SubsidiaryFactory;
use Modules\Companies\Entities\Companies\Company;

class Subsidiary extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'subsidiaries';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'city_id',
        'parent_id',
        'opening_hours',
        'company_id'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
        'city_id',
        'city',
        'employees',
        'opening_hours',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'subsidiaries.name' => 10,
            'cities.city'       => 10
        ],
        'joins' => [
            'cities' => ['cities.id', 'subsidiaries.city_id'],
        ]
    ];

    protected static function newFactory()
    {
        return SubsidiaryFactory::new();
    }

    public function searchSubsidiary($term)
    {
        return self::search($term, null, true, true);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)->with(['province'])
            ->select(['id', 'city', 'province_id', 'is_active']);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class)
            ->select(['id', 'name', 'phone', 'subsidiary_id', 'is_active']);
    }

    public function company(): HasMany
    {
        return $this->hasMany(Company::class)->select(['id', 'name']);
    }
}
