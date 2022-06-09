<?php

namespace Modules\Customers\Entities\CustomerCompanies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Generals\Entities\Cities\City;
use Nicolaslopezj\Searchable\SearchableTrait;

class CustomerCompany extends Model
{
    use SearchableTrait;
    protected $table = 'customer_companies';

    protected $fillable = [
        'customer_id',
        'constitution_type',
        'company_legal_name',
        'company_commercial_name',
        'company_address',
        'neighborhood',
        'company_id_number',
        'prefix',
        'company_phone',
        'city_id',
        'logo',
        'file',
        'subsidiaries',
        'is_active',
        'is_aprobed'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = [
        'id',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = ['created_at', 'updated_at'];

    protected $searchable = [
        'columns' => [
            'customer_companies.company_legal_name'  => 10,
            'customers.name'                         => 10
        ],
        'joins' => [
            'customers' => ['customers.id', 'customer_companies.customer_id']
        ]
    ];

    public function searchCustomerCompanies($term)
    {
        return self::search($term, null, true, true);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }
}
