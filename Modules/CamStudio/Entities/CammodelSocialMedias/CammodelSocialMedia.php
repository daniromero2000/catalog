<?php

namespace Modules\CamStudio\Entities\CammodelSocialMedias;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\Companies\Entities\CorporatePhones\CorporatePhone;
use Modules\Generals\Entities\SocialMedias\SocialMedia;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelSocialMedia extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $table = 'cammodel_social_media';

    protected $fillable = [
        'profile',
        'user',
        'password',
        'cammodel_id',
        'social_media_id',
        'corporate_phone_id',
        'is_active',
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
            'cammodel_social_media.profile' => 10,
            'cammodels.nickname'            => 10,
            'social_media.social'           => 10
        ],
        'joins' => [
            'cammodels'    => ['cammodels.id', 'cammodel_social_media.cammodel_id'],
            'social_media' => ['social_media.id', 'cammodel_social_media.social_media_id'],
        ]
    ];

    public function searchCammodelSocialMedias($term)
    {
        return self::search($term, null, true, true);
    }

    public function socialMedia(): BelongsTo
    {
        return $this->belongsTo(SocialMedia::class)
            ->orderBy('created_at', 'desc')
            ->select(['id', 'social', 'url', 'icon']);
    }

    public function cammodel(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class)
            ->orderBy('created_at', 'desc')->select(['id', 'nickname']);
    }

    public function corporatePhone(): BelongsTo
    {
        return $this->belongsTo(CorporatePhone::class)
            ->select(['id', 'simcard_number', 'phone']);
    }
}
