<?php

namespace Modules\CamStudio\Entities\CammodelStreamAccounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\Streamings\Entities\Streamings\Streaming;
use Modules\Companies\Entities\CorporatePhones\CorporatePhone;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelStreamAccount extends Model
{
    use SoftDeletes, SearchableTrait;

    protected $table = 'cammodel_stream_accounts';

    protected $fillable = [
        'cammodel_id',
        'streaming_id',
        'corporate_phone_id',
        'profile',
        'user',
        'password',
        'embed_link',
        'account_api_token',
        'set_up',
        'is_active',
        'deleted_at'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'cammodel_stream_accounts.profile' => 10,
            'cammodel_stream_accounts.user'    => 10,
            'cammodels.nickname'               => 10,
            'streamings.streaming'             => 10
        ],
        'joins' => [
            'cammodels'  => ['cammodels.id', 'cammodel_stream_accounts.cammodel_id'],
            'streamings' => ['streamings.id', 'cammodel_stream_accounts.streaming_id']
        ]
    ];

    public function searchCammodelStreamAccounts($term)
    {
        return self::search($term, null, true, true);
    }

    public function streaming(): BelongsTo
    {
        return $this->belongsTo(Streaming::class)->orderBy('created_at', 'desc')
            ->select(['id', 'streaming', 'url', 'icon', 'usd_token_rate', 'is_automated']);
    }

    public function streamingWithRate(): BelongsTo
    {
        return $this->belongsTo(Streaming::class, 'streaming_id')
            ->orderBy('created_at', 'desc')->select(['id', 'usd_token_rate']);
    }

    public function cammodel(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class)
            ->orderBy('created_at', 'desc')->select(['id', 'nickname']);
    }

    public function cammodelWithEmployee(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class, 'cammodel_id')
            ->orderBy('created_at', 'desc')->with('employeeName', 'shift')
            ->select(['id', 'nickname', 'employee_id', 'is_active', 'shift_id']);
    }

    public function corporatePhone(): BelongsTo
    {
        return $this->belongsTo(CorporatePhone::class)
            ->select(['id', 'simcard_number', 'phone']);
    }
}
