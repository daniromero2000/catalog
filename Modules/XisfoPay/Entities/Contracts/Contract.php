<?php

namespace Modules\XisfoPay\Entities\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\XisfoPay\Entities\ContractCommentaries\ContractCommentary;
use Modules\XisfoPay\Entities\ContractRenewals\ContractRenewal;
use Modules\XisfoPay\Entities\ContractStatuses\ContractStatus;
use Modules\XisfoPay\Entities\ContractStatusesLogs\ContractStatusesLog;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;
use Nicolaslopezj\Searchable\SearchableTrait;

class Contract extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'contracts';

    protected $fillable = [
        'contract_status_id',
        'is_signed',
        'is_active',
        'is_aprobed',
        'physical_file'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = [
        'id',
        'updated_at'
    ];

    protected $dates  = ['created_at', 'updated_at'];

    protected $searchable = [
        'columns' => [
            'contract_requests.client_identifier'        => 10,
            'customers.name'                             => 10,
            'customer_companies.company_legal_name'      => 5,
            'customer_companies.company_commercial_name' => 5
        ],
        'joins' => [
            'contract_requests' => ['contracts.id', 'contract_requests.contract_id'],
            'customers'         => ['customers.id', 'contract_requests.customer_id'],
            'customer_companies' => ['customers.id', 'customer_companies.customer_id'],
        ]
    ];

    public function searchContract($term)
    {
        return self::search($term, null, true, true);
    }

    public function contractStatus(): BelongsTo
    {
        return $this->belongsTo(ContractStatus::class)
            ->select(['id', 'name', 'color']);
    }

    public function contractCommentaries(): HasMany
    {
        return $this->hasMany(ContractCommentary::class)
            ->select(['id', 'commentary', 'user', 'contract_id', 'created_at'])
            ->orderBy('created_at', 'desc');
    }

    public function contractStatusesLogs(): HasMany
    {
        return $this->hasMany(ContractStatusesLog::class)
            ->orderBy('id', 'desc')
            ->select(['id', 'contract_id', 'user', 'status', 'time_passed', 'created_at']);
    }

    public function contractRenewals(): HasMany
    {
        return $this->hasMany(ContractRenewal::class)->with(['contractRate'])
            ->select(['id', 'starts', 'expires', 'file', 'contract_id', 'contract_rate_id', 'is_special_price', 'is_aprobed', 'is_active', 'created_at'])
            ->orderBy('created_at', 'desc');
    }

    public function contractRequests(): HasMany
    {
        return $this->hasMany(ContractRequest::class)->with(['customer', 'contractRequestStreamAccount', 'customerCompany'])
            ->select(['id', 'contract_request_status_id', 'customer_id', 'client_identifier', 'contract_id', 'is_signed', 'customer_company_id', 'contract_request_type', 'created_at']);
    }
}
