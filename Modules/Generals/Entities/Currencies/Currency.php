<?php

namespace Modules\Generals\Entities\Currencies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Generals\Database\factories\CurrencyFactory;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $guarded  = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $hidden   = ['deleted_at'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return CurrencyFactory::new();
    }
}
