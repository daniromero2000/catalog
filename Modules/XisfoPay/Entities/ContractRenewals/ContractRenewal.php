<?php

namespace Modules\XisfoPay\Entities\ContractRenewals;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\XisfoPay\Entities\ContractRates\ContractRate;
use Modules\XisfoPay\Entities\Contracts\Contract;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContractRenewal extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'contract_renewals';

    protected $fillable = [
        'starts',
        'expires',
        'file',
        'contract_id',
        'contract_rate_id',
        'is_special_price',
        'is_aprobed'
    ];

    protected $hidden = [
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = [
        'created_at',
        'updated_at',
        'starts',
        'expires'
    ];

    protected $searchable = [
        'columns' => [
            'contract_renewals.id'                  => 10,
            'contract_requests.client_identifier'   => 10,
            'customers.name'                        => 10,
            'customer_companies.company_legal_name' => 5
        ],
        'joins' => [
            'contracts'          => ['contracts.id', 'contract_renewals.contract_id'],
            'contract_requests'  => ['contracts.id', 'contract_requests.contract_id'],
            'customers'          => ['customers.id', 'contract_requests.customer_id'],
            'customer_companies' => ['customers.id', 'customer_companies.customer_id'],
        ]
    ];

    public function searchContractRenewals($term)
    {
        return self::search($term, null, true, true);
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class)->with(['contractRequests'])
            ->select(['id', 'is_active', 'created_at']);
    }

    public function contractRate(): BelongsTo
    {
        return $this->belongsTo(ContractRate::class)
            ->select(['id', 'percentage', 'type',  'value']);
    }
}
