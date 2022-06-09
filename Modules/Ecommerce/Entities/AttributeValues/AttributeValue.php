<?php

namespace Modules\Ecommerce\Entities\AttributeValues;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Database\factories\AttributeValueFactory;

class AttributeValue extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'attribute_values';

    protected $fillable = [
        'value',
        'sort_order',
        'description',
        'attribute_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return AttributeValueFactory::new();
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class)
            ->select(['id', 'name', 'is_visible_on_front', 'is_active']);
    }

    public function productAttributes(): BelongsToMany
    {
        return $this->belongsToMany(ProductAttribute::class);
    }
}
