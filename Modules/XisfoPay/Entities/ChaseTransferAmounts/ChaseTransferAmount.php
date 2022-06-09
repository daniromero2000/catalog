<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Streamings\Entities\Streamings\Streaming;
use Modules\XisfoPay\Entities\ChaseTransfers\ChaseTransfer;
use Nicolaslopezj\Searchable\SearchableTrait;

class ChaseTransferAmount extends Model
{
    use SearchableTrait;
    protected $table = 'chase_transfer_amounts';

    protected $fillable = [
        'amount',
        'chase_transfer_id',
        'streaming_id',
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
            'streamings.streaming' => 10,
            'banks.name'           => 10
        ],
        'joins' => [
            'streamings'          => ['streamings.id', 'chase_transfer_amounts.streaming_id'],
            'chase_transfers'     => ['chase_transfers.id', 'chase_transfer_amounts.chase_transfer_id'],
            'chase_transfer_trms' => ['chase_transfer_trms.id', 'chase_transfers.chase_transfer_trm_id'],
            'banks'               => ['banks.id', 'chase_transfer_trms.bank_id'],
        ]
    ];

    public function searchChaseTransferAmounts($term)
    {
        return self::search($term, null, true, true);
    }

    public function streaming(): BelongsTo
    {
        return $this->belongsTo(Streaming::class)
            ->select(['id', 'streaming', 'usd_commission', 'usd_token_rate']);
    }

    public function chaseTransfer(): BelongsTo
    {
        return $this->belongsTo(ChaseTransfer::class)->with(['chaseTransferTrm'])
            ->select(['id', 'chase_transfer_trm_id', 'created_at']);
    }
}
