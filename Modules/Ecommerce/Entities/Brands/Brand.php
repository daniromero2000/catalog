<?php

namespace Modules\Ecommerce\Entities\Brands;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Database\factories\BrandFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class Brand extends Model
{
    use SoftDeletes, SearchableTrait, HasFactory;
    protected $table = 'brands';

    protected $fillable = [
        'name',
        'logo',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'brands.name' => 10,
        ]
    ];

    public function searchBrands($term)
    {
        return self::search($term, null, true, true);
    }

    protected static function newFactory()
    {
        return BrandFactory::new();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)
            ->select(['id', 'company_id', 'brand_id', 'sku', 'name', 'slug', 'description', 'cover', 'quantity', 'price', 'base_price', 'sale_price', 'special_price', 'tax_id', 'is_visible_on_front', 'is_active', 'created_at']);
    }
}
