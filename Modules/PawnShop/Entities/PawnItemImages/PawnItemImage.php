<?php

namespace Modules\PawnShop\Entities\PawnItemImages;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PawnItemImage extends Model
{
    use SearchableTrait;
    protected $table = 'pawn_item_images';
    public $timestamps = false;

    protected $fillable = [
        'pawn_item_id',
        'src'
    ];

    protected $hidden = [
        'id'
    ];

    protected $guarded = [
        'id'
    ];
}
