<?php

namespace Modules\XisfoPay\Entities\ContractRates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\XisfoPay\Database\factories\ContractRateFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContractRate extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'contract_rates';

    protected $fillable = [
        'percentage',
        'type',
        'value',
        'is_aprobed',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'contract_rates.percentage' => 10,
            'contract_rates.value' => 10
        ]
    ];

    public function searchContractRate($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return ContractRateFactory::new();
    }
}
