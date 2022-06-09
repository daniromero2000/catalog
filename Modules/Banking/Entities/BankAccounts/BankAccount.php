<?php

namespace Modules\Banking\Entities\BankAccounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Banking\Entities\BankMovements\BankMovement;
use Modules\Banking\Entities\Banks\Bank;
use Nicolaslopezj\Searchable\SearchableTrait;

class BankAccount extends Model
{
    use SearchableTrait;
    protected $table    = 'bank_accounts';
    protected $fillable = ['name', 'account_number', 'bank_id',  'is_active'];
    protected $hidden   = ['updated_at', 'id',];
    protected $guarded  = ['id', 'created_at', 'updated_at'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'banks.name' => 10
        ],
        'joins' => [
            'banks' => ['banks.id', 'bank_accounts.bank_id'],
        ]
    ];

    public function searchBankAccounts($term)
    {
        return self::search($term, null, true, true);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class)->with(['country'])
            ->select(['id', 'name', 'country_id']);
    }

    public function bankMovements(): HasMany
    {
        return $this->hasMany(BankMovement::class)
            ->select([
                'id', 'bank_account_id', 'movement_type', 'amount',
                'total_bank_amount', 'created_at'
            ]);
    }
}
