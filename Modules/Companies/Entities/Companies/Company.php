<?php

namespace Modules\Companies\Entities\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Database\factories\CompanyFactory;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Generals\Entities\Countries\Country;

class Company extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'identification',
        'company_type',
        'description',
        'country_id',
        'logo',
        'base_currency_id'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'companies.id'   => 10,
            'companies.name' => 10,
            'countries.name' => 10
        ],
        'joins' => [
            'countries' => ['countries.id', 'companies.country_id'],
        ]
    ];

    protected static function newFactory()
    {
        return CompanyFactory::new();
    }

    public function searchCompany($term)
    {
        return self::search($term, null, true, true);
    }

    public function countries(): BelongsTo
    {
        return $this->belongsTo(Country::class)
            ->select(['id', 'name', 'is_active']);
    }
}
