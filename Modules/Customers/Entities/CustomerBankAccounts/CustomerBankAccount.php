<?php

namespace Modules\Customers\Entities\CustomerBankAccounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Banking\Entities\Banks\Bank;
use Nicolaslopezj\Searchable\SearchableTrait;

class CustomerBankAccount extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'customer_bank_accounts';

    protected $fillable = [
        'customer_id',
        'bank_id',
        'account_type',
        'account_number',
        'account_certificate',
        'customer_identity_id',
        'is_active',
        'is_aprobed'
    ];

    protected $hidden = [
        'updated_at',
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
            'customer_bank_accounts.bank_id'        => 10,
            'customer_bank_accounts.account_number' => 10,
            'customers.name'                        => 10,
            'banks.name'                            => 10
        ],
        'joins' => [
            'customers' => ['customers.id', 'customer_bank_accounts.customer_id'],
            'banks' => ['banks.id', 'customer_bank_accounts.bank_id'],
        ]
    ];

    public function searchCustomerBankAccounts($term)
    {
        return self::search($term, null, true, true);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->with('customerIdentities')
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday',
                'scholarity_id', 'status', 'customer_status_id',
                'customer_channel_id', 'city_id', 'data_politics', 'genre_id',
                'customer_channel_id', 'civil_status_id', 'scholarity_id',
                'email', 'created_at'
            ]);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function bankNames(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id')->select(['id', 'name']);
    }

    public function bankAccountCustomerIdentity(): BelongsTo
    {
        return $this->belongsTo(CustomerIdentity::class, 'customer_identity_id');
    }
}
