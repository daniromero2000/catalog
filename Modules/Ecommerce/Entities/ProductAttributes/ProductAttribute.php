<?php

namespace Modules\Ecommerce\Entities\ProductAttributes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Database\factories\ProductAttributeFactory;

class ProductAttribute extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'product_attributes';

    protected $fillable = [
        'quantity',
        'price',
        'sale_price',
        'default',
        'product_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return ProductAttributeFactory::new();
    }

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->select([
                'id',
                'company_id',
                'brand_id',
                'sku',
                'name',
                'slug',
                'description',
                'cover',
                'quantity',
                'price',
                'base_price',
                'sale_price',
                'special_price',
                'tax_id',
                'is_visible_on_front',
                'is_active',
                'created_at'
            ]);
    }

    public function attributesValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class)->orderBy('value')->with('attribute')
            ->select(['id', 'value', 'description', 'sort_order', 'attribute_id'])->orderBy('value', 'asc');
    }

    public function attributesValuesForExport(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class)->orderBy('value')
            ->select(['value',]);
    }
}
