<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Streamings\Entities\Streamings\Streaming;
use Modules\XisfoPay\Entities\ContractRequests\ContractRequest;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\ContractRequestStreamAccountCommission;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContractRequestStreamAccount extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'contract_request_stream_accounts';

    protected $fillable = [
        'contract_request_id',
        'streaming_id',
        'contract_request_stream_account_commission_id',
        'nickname',
        'set_up',
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
            'contract_request_stream_accounts.nickname'     => 10,
            'contract_request_stream_accounts.streaming_id' => 10,
            'contract_requests.client_identifier'           => 10,
            'customers.name'                                => 10,
            'customer_companies.company_legal_name'         => 5,
            'customer_companies.company_commercial_name'    => 5
        ],
        'joins' => [
            'contract_requests'  => ['contract_requests.id', 'contract_request_stream_accounts.contract_request_id'],
            'customers'          => ['customers.id', 'contract_requests.customer_id'],
            'customer_companies' => ['customers.id', 'customer_companies.customer_id'],
        ]
    ];

    public function searchContractRequestStreamAccount($term)
    {
        return self::search($term, null, true, true);
    }

    public function contractRequest(): BelongsTo
    {
        return $this->belongsTo(ContractRequest::class)->with(['contract', 'customer', 'customerCompany'])
            ->select(['id', 'client_identifier', 'customer_id', 'contract_id', 'contract_request_status_id', 'customer_company_id', 'finantial_retention', 'is_bank_processing_commission_free']);
    }

    public function streaming(): BelongsTo
    {
        return $this->belongsTo(Streaming::class, 'streaming_id', 'id')
            ->select(['id', 'streaming', 'usd_commission', 'usd_token_rate', 'is_active']);
    }

    public function contractRequestStreamAccountCommission(): BelongsTo
    {
        return $this->belongsTo(ContractRequestStreamAccountCommission::class)->with(['streaming'])
            ->select(['id', 'streaming_id', 'amount']);
    }
}
