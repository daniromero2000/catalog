<?php

namespace Modules\XisfoPay\Entities\ChaseTransferTrms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Banking\Entities\Banks\Bank;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;
use Nicolaslopezj\Searchable\SearchableTrait;

class ChaseTransferTrm extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'chase_transfer_trms';

    protected $fillable = [
        'trm',
        'bank_id',
        'user',
        'is_active'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'chase_transfer_trms.trm'  => 10,
            'chase_transfer_trms.user' => 10,
            'banks.name'               => 10
        ],
        'joins' => [
            'banks' => ['banks.id', 'chase_transfer_trms.bank_id'],
        ]
    ];

    public function searchChaseTransferTrms($term)
    {
        return self::search($term, null, true, true);
    }

    public function PaymentCuts(): HasMany
    {
        return $this->hasMany(PaymentCut::class)->select(['id', 'chase_transfer_trm_id']);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class)
            ->select(['id', 'name', 'transfer_rate', 'draft_rate']);
    }
}
