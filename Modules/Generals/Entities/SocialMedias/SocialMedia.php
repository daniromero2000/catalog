<?php

namespace Modules\Generals\Entities\SocialMedias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Database\factories\SocialMediaFactory;

class SocialMedia extends Model
{
    use SoftDeletes, HasFactory;

    protected $table    = 'social_media';
    protected $fillable = ['id', 'social', 'url', 'icon'];
    protected $hidden   = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return SocialMediaFactory::new();
    }
}
