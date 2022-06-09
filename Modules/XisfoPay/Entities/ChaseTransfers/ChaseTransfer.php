<?php

namespace Modules\XisfoPay\Entities\ChaseTransfers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\ChaseTransferAmount;
use Modules\XisfoPay\Entities\ChaseTransferTrms\ChaseTransferTrm;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;
use Nicolaslopezj\Searchable\SearchableTrait;

class ChaseTransfer extends Model
{
    use SearchableTrait;
    protected $table = 'chase_transfers';

    protected $fillable = [
        'chase_transfer_trm_id',
        'transfer_amount',
        'commission',
        'user_approves',
        'is_approved',
        'bank_movement_id',
        'created_at'
    ];

    protected $hidden = [
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'chase_transfers.id'  => 10,
            'banks.name'          => 10
        ],
        'joins' => [
            'chase_transfer_trms' => ['chase_transfer_trms.id', 'chase_transfers.chase_transfer_trm_id'],
            'banks'            => ['banks.id', 'chase_transfer_trms.bank_id'],
        ]
    ];

    public function searchChaseTransfers($term)
    {
        return self::search($term, null, true, true);
    }

    public function ChaseTransferTrm(): BelongsTo
    {
        return $this->belongsTo(ChaseTransferTrm::class)->with(['bank'])
            ->select(['id', 'trm', 'bank_id']);
    }

    public function chaseTransferAmounts(): HasMany
    {
        return $this->hasMany(ChaseTransferAmount::class)->with(['streaming'])
            ->select(['id', 'streaming_id', 'amount', 'created_at', 'chase_transfer_id']);
    }

    public function paymentRequests(): HasMany
    {
        return $this->hasMany(PaymentRequest::class)->with('contractRequestStreamAccount')
            ->select([
                'id', 'contract_request_stream_account_id',
                'chase_transfer_id', 'usd_amount', 'commission',
                'real_commission', 'created_at']);
    }
}
