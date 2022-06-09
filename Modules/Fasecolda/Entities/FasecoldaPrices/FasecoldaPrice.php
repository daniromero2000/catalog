<?php

namespace Modules\Fasecolda\Entities\FasecoldaPrices;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Fasecolda\Entities\FasecoldaCodes\FasecoldaCode;

class FasecoldaPrice extends Model
{
    protected $table = 'fasecolda_prices';

    protected $fillable = [
        'Codigo',
        'Modelo',
        'Valor'
    ];

    protected $dates  = ['created_at', 'updated_at'];

    protected $hidden = [];

    protected $guarded = [
        'id',
        'deleted_at',
        'updated_at'
    ];

    public function fasecoldaCode(): HasMany
    {
        return $this->hasMany(FasecoldaCode::class, 'Codigo', 'Codigo');
    }
}
