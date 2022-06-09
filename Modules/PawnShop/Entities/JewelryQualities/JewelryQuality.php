<?php

namespace Modules\PawnShop\Entities\JewelryQualities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PawnShop\Database\factories\JewelryQualityFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class JewelryQuality extends Model
{
    use HasFactory, SearchableTrait;
    protected $table = 'jewelry_qualities';

    protected $fillable = [
        'name',
        'price'
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
            'jewelry_qualities.name' => 10,
        ]
    ];

    public function searchJewelryQuality($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return JewelryQualityFactory::new();
    }
}
