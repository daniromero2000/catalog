<?php

namespace Modules\PawnShop\Entities\FasecoldaPriceRates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\PawnShop\Database\factories\FasecoldaPriceRateFactory;
use Modules\PawnShop\Entities\PawnItems\PawnItem;
use Nicolaslopezj\Searchable\SearchableTrait;

class FasecoldaPriceRate extends Model
{
    use HasFactory, SearchableTrait;
    protected $table = 'fasecolda_price_rates';

    protected $fillable = [
        'name',
        'price'
    ];

    protected $dates   = [
        'created_at',
        'updated_at'
    ];

    protected $hidden  = [];

    protected $guarded = [
        'id',
        'deleted_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'fasecolda_price_rates.name' => 10,
        ]
    ];

    public function searchFasecoldaPriceRate($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return FasecoldaPriceRateFactory::new();
    }

    public function items(): HasMany
    {
        return $this->hasMany(PawnItem::class);
    }
}
