<?php

namespace Modules\CamStudio\Entities\StreamingStats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CamStudio\Entities\CammodelStreamAccounts\CammodelStreamAccount;
use Nicolaslopezj\Searchable\SearchableTrait;

class StreamingStat extends Model
{
    use SearchableTrait;
    protected $table = 'streaming_stats';

    protected $fillable = [
        'cammodel_stream_account_id',
        'time_online',
        'tips_in_last_hour',
        'num_followers',
        'token_balance',
        'satisfaction_score',
        'num_tokened_viewers',
        'votes_down',
        'votes_up',
        'last_broadcast',
        'num_registered_viewers',
        'num_viewers',
        'deleted_at'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = [
        'created_at',
        'updated_at',
        'last_broadcast'
    ];

    protected $searchable = [
        'columns' => [
            'streaming_stats.cammodel_stream_account_id' => 10,
        ]
    ];

    public function searchStreamingStat($term)
    {
        return self::search($term, null, true, true);
    }

    public function cammodelStreamAccount(): BelongsTo
    {
        return $this->belongsTo(CammodelStreamAccount::class)
            ->select(['id', 'profile']);
    }
}
