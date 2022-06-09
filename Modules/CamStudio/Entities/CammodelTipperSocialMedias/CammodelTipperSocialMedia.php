<?php

namespace Modules\CamStudio\Entities\CammodelTipperSocialMedias;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CamStudio\Entities\CammodelTippers\CammodelTipper;
use Modules\Generals\Entities\SocialMedias\SocialMedia;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelTipperSocialMedia extends Model
{
    use SearchableTrait;

    protected $table = 'cammodel_tipper_social_media';

    protected $fillable = [
        'profile',
        'cammodel_tipper_id',
        'social_media_id',
        'deleted_at'
    ];

    protected $hidden   = ['created_at', 'updated_at'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'cammodel_tipper_social_media.profile' => 10,
            'cammodel_tippers.profile'             => 10,
            'social_media.social'                  => 10
        ],
        'joins' => [
            'social_media'     => ['social_media.id', 'cammodel_tipper_social_media.social_media_id'],
            'cammodel_tippers' => ['cammodel_tippers.id', 'cammodel_tipper_social_media.cammodel_tipper_id']
        ]
    ];

    public function searchCammodelTipperSocialMedias($term)
    {
        return self::search($term, null, true, true);
    }

    public function socialMedia(): BelongsTo
    {
        return $this->belongsTo(SocialMedia::class)
            ->orderBy('created_at', 'desc')
            ->select(['id', 'social', 'url', 'icon']);
    }

    public function cammodelTipper(): BelongsTo
    {
        return $this->belongsTo(cammodelTipper::class)
            ->orderBy('created_at', 'desc')->select(['id', 'profile']);
    }
}
