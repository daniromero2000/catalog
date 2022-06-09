<?php

namespace Modules\Ecommerce\Entities\Attributes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Database\factories\AttributeFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class Attribute extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'is_active',
        'sort_order'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
        'is_active'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'attributes.name' => 10,
        ]
    ];

    public function searchAttribute($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return AttributeFactory::new();
    }

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class)
            ->select(['id', 'value', 'description', 'attribute_id'])->orderBy('value', 'asc');
    }

    public function attributeValue(): HasMany
    {
        return $this->hasMany(AttributeValue::class)
            ->select(['id', 'value', 'description', 'attribute_id'])->orderBy('value');
    }
}
