<?php

namespace Modules\XisfoPay\Entities\ContractRequests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Customers\Entities\CustomerCompanies\CustomerCompany;
use Modules\Customers\Entities\Customers\Customer;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\ContractRequestCommentary;
use Modules\XisfoPay\Entities\ContractRequestStatuses\ContractRequestStatus;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\ContractRequestStreamAccount;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\ContractRequestStatusesLog;
use Modules\XisfoPay\Entities\Contracts\Contract;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContractRequest extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'contract_requests';

    protected $fillable = [
        'client_identifier',
        'customer_id',
        'contract_id',
        'employee_id',
        'contract_request_status_id',
        'file',
        'physical_file',
        'is_signed',
        'is_aprobed',
        'is_active',
        'finantial_retention',
        'contract_request_type',
        'is_bank_processing_commission_free',
        'customer_company_id'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at'];

    protected $searchable = [
        'columns' => [
            'contract_requests.client_identifier'        => 10,
            'contract_request_stream_accounts.nickname'  => 8,
            'customers.email'                            => 8,
            'customer_companies.company_commercial_name' => 9,
            'customer_companies.company_legal_name'      => 9,
            'customer_companies.company_id_number'       => 9,
        ],
        'joins' => [
            'contract_request_stream_accounts' => ['contract_requests.id', 'contract_request_stream_accounts.contract_request_id'],
            'customers'                        => ['customers.id', 'contract_requests.customer_id'],
            'customer_companies'               => ['customer_companies.id', 'contract_requests.customer_company_id']
        ]
    ];

    public function searchContractRequest($term)
    {
        return self::search($term, null, true, true);
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class)->with(['contractRenewals'])
            ->select(['id', 'contract_status_id', 'is_signed', 'is_active', 'created_at']);
    }

    public function contractRequestStatus(): BelongsTo
    {
        return $this->belongsTo(ContractRequestStatus::class)
            ->select(['id', 'name', 'color']);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->with([
            'customerPhones',
            'customerEmails',
            'customerIdentities',
            'customerCompanies',
            'customerAddresses',
            'customerBankAccounts',
            'genre',
            'civilStatus',
            'customerGroup',
            'customerReferences',
            'city',
            'birthCity'
        ])->select(['id', 'name', 'email', 'last_name', 'birthday', 'birth_place_id', 'city_id', 'civil_status_id', 'genre_id', 'customer_group_id']);
    }

    public function contractRequestCommentaries(): HasMany
    {
        return $this->hasMany(ContractRequestCommentary::class)
            ->orderBy('created_at', 'desc')
            ->select(['id', 'commentary', 'contract_request_id', 'user', 'created_at']);
    }

    public function contractRequestStatusesLogs(): HasMany
    {
        return $this->hasMany(ContractRequestStatusesLog::class)
            ->orderBy('created_at', 'desc')
            ->select(['id', 'contract_request_id', 'user', 'status', 'time_passed', 'created_at']);
    }

    public function contractRequestStreamAccount(): HasMany
    {
        return $this->hasMany(ContractRequestStreamAccount::class)
            ->with((['streaming', 'contractRequestStreamAccountCommission']))
            ->select([
                'id', 'contract_request_id', 'streaming_id', 'nickname',
                'set_up', 'is_active', 'created_at',
                'contract_request_stream_account_commission_id'
            ]);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->select(['id', 'name', 'last_name', 'signature']);
    }

    public function customerCompany(): BelongsTo
    {
        return $this->belongsTo(CustomerCompany::class)
            ->select([
                'id', 'customer_id', 'constitution_type', 'company_legal_name', 'company_commercial_name', 'company_id_number', 'company_address',
                'neighborhood', 'prefix', 'company_phone', 'city_id', 'logo', 'file', 'is_active', 'is_aprobed', 'subsidiaries', 'created_at'
            ]);
    }
}
