<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Streamings\Entities\Streamings\Streaming;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContractRequestStreamAccountCommission extends Model
{
    use SearchableTrait;
    protected $table = 'contract_request_stream_account_commissions';

    protected $fillable = [
        'amount',
        'is_default',
        'streaming_id'
    ];

    protected $hidden = [
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'streamings.name' => 10
        ],
        'joins' => [
            'streamings' => ['streamings.id', 'contract_request_stream_account_commissions.streaming_id'],
        ]
    ];

    public function searchContractRequestStreamAccountCommissions($term)
    {
        return self::search($term, null, true, true);
    }

    public function streaming(): BelongsTo
    {
        return $this->belongsTo(Streaming::class)
            ->select(['id', 'streaming', 'usd_commission', 'usd_token_rate']);
    }
}
