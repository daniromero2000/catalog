<?php

namespace Modules\CamStudio\Entities\CammodelTippers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\CammodelTipperSocialMedia;
use Modules\Streamings\Entities\Streamings\Streaming;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelTipper extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'cammodel_tippers';

    protected $fillable = [
        'profile',
        'nickname',
        'streaming_id',
        'birthday',
        'location',
        'pleasures',
        'rate',
        'observations'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $searchable = [
        'columns' => [
            'cammodel_tippers.id'      => 10,
            'cammodel_tippers.profile' => 10,
            'streamings.streaming'     => 10
        ],
        'joins' => [
            'streamings' => ['streamings.id', 'cammodel_tippers.streaming_id']
        ]
    ];

    public function searchCammodelTipper($term)
    {
        return self::search($term, null, true, true);
    }

    public function streaming(): BelongsTo
    {
        return $this->belongsTo(Streaming::class)->select(['id', 'streaming']);
    }

    public function cammodels(): BelongsToMany
    {
        return $this->belongsToMany(Cammodel::class);
    }

    public function cammodelTipperSocialMedia(): HasMany
    {
        return $this->hasMany(CammodelTipperSocialMedia::class)
            ->with(['socialMedia'])
            ->select(['id', 'profile', 'social_media_id']);
    }
}
