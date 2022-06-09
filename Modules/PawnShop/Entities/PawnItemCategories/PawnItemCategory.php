<?php

namespace Modules\PawnShop\Entities\PawnItemCategories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\PawnShop\Entities\PawnItems\PawnItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\PawnShop\Database\factories\PawnItemCategoryFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class PawnItemCategory extends Model
{
    use HasFactory, SearchableTrait;
    protected $table = 'pawn_item_categories';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [];

    protected $dates   = [
        'created_at',
        'updated_at'
    ];


    protected $guarded = [
        'id',
        'deleted_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'pawn_item_categories.name' => 10,
        ]
    ];

    public function searchPawnItemCategory($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return PawnItemCategoryFactory::new();
    }

    public function items(): HasMany
    {
        return $this->hasMany(PawnItem::class);
    }
}
