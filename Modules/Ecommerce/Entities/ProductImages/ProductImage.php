<?php

namespace Modules\Ecommerce\Entities\ProductImages;

use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $table    = 'product_images';
    protected $fillable = ['product_id', 'product_attribute_id', 'src'];
    protected $hidden   = ['id'];
    protected $guarded  = ['id',];
    protected $dates    = [];
    public $timestamps  = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)
            ->select(
                ['id', 'company_id', 'brand_id', 'sku', 'name', 'slug', 'description', 'cover', 'quantity', 'price', 'base_price', 'sale_price', 'special_price', 'tax_id', 'is_visible_on_front', 'is_active', 'created_at']
            );
    }
}
