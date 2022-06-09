<?php

namespace Modules\CamStudio\Entities\CammodelImages;

use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CammodelImage extends Model
{
    protected $table    = 'cammodel_images';
    protected $fillable = ['cammodel_id', 'src'];
    protected $hidden   = ['id'];
    protected $guarded  = ['id'];
    protected $dates    = [];
    public $timestamps  = false;

    public function cammodel(): BelongsTo
    {
        return $this->belongsTo(Cammodel::class);
    }
}
