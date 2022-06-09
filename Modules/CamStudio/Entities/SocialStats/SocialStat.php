<?php

namespace Modules\CamStudio\Entities\SocialStats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CamStudio\Entities\CammodelSocialMedias\CammodelSocialMedia;
use Nicolaslopezj\Searchable\SearchableTrait;

class SocialStat extends Model
{
    use SearchableTrait;
    protected $table = 'social_stats';

    protected $fillable = [
        'cammodel_social_media_id',
        'followers_count',
        'deleted_at'
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
            'social_stats.cammodel_social_media_id' => 10,
        ]
    ];

    public function searchSocialStat($term)
    {
        return self::search($term, null, true, true);
    }

    public function cammodelSocialMedia(): BelongsTo
    {
        return $this->belongsTo(CammodelSocialMedia::class)
            ->select(['id', 'profile']);
    }
}
