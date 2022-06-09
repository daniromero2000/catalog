<?php

namespace Modules\Customers\Entities\CustomerEconomicActivities;

use Modules\Generals\Entities\Cities\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Generals\Entities\EconomicActivityTypes\EconomicActivityType;
use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;

class CustomerEconomicActivity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'economic_activity_type_id',
        'entity_name',
        'professions_list_id',
        'start_date',
        'incomes',
        'other_incomes',
        'other_incomes_source',
        'expenses',
        'entity_address',
        'entity_phone',
        'city_id',
        'status'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }

    public function economicActivityType(): BelongsTo
    {
        return $this->belongsTo(EconomicActivityType::class)
            ->select(['id', 'economic_activity_type']);
    }

    public function professionsList(): BelongsTo
    {
        return $this->belongsTo(ProfessionsList::class)
            ->select(['id', 'ciuo', 'profession']);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }
}
