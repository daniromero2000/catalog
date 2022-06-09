<?php

namespace Modules\Banking\Entities\BankMovements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Banking\Entities\BankAccounts\BankAccount;
use Nicolaslopezj\Searchable\SearchableTrait;

class BankMovement extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'bank_movements';

    protected $fillable = [
        'bank_account_id',
        'movement_type',
        'amount',
        'total_bank_amount',
        'trm',
        'description',
        'created_at'
    ];

    protected $hidden  = ['updated_at', 'id'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'banks.name' => 10
        ],
        'joins' => [
            'bank_accounts' => ['bank_accounts.id', 'bank_movements.bank_account_id'],
            'banks'         => ['banks.id', 'bank_accounts.bank_id'],
        ]
    ];

    public function searchBankMovements($term)
    {
        return self::search($term, null, true, true);
    }

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class)->with(['bank'])
            ->select(['id', 'name', 'bank_id']);
    }
}
