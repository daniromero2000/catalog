<?php

namespace Modules\PawnShop\Entities\PawnItemStatuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PawnShop\Database\factories\PawnItemStatusFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class PawnItemStatus extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'pawn_item_statuses';

    protected $fillable = [
        'name',
        'color',
        'is_active'
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
            'pawn_item_statuses.name'  => 10,
        ]
    ];

    public function searchPawnItemStatus($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return PawnItemStatusFactory::new();
    }

    public function items(): HasMany
    {
        return $this->hasMany(PawmItem::class);
    }
}
