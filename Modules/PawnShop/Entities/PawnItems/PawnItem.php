<?php

namespace Modules\PawnShop\Entities\PawnItems;

use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Customers\Entities\Customers\Customer;
use Modules\PawnShop\Entities\PawnPawnItemImages\PawnItemImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class PawnItem extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'pawn_item_category_id',
        'price',
        'approbed_price',
        'fasecolda_code',
        'customer_id',
        'pawn_item_status_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'pawn_items.id'             => 10,
            'pawn_items.name'           => 10,
            'pawn_item_categories.name' => 10,
            'pawn_item_statuses.name'   => 10,
            'customers.name'            => 10,
            'pawn_items.description'    => 5
        ],
        'joins' => [
            'customers'            => ['customers.id', 'pawn_items.customer_id'],
            'pawn_item_categories' => ['pawn_item_categories.id', 'pawn_items.pawn_item_category_id'],
            'pawn_item_statuses'   => ['pawn_item_statuses.id', 'pawn_items.pawn_item_status_id']
        ],
        'groupBy' => ['pawn_items.id']
    ];

    public function searchPawnItem($term)
    {
        return self::search($term, null, true, true);
    }

    public function subsidiaries(): BelongsToMany
    {
        return $this->belongsToMany(Subsidiary::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PawnItemImage::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
