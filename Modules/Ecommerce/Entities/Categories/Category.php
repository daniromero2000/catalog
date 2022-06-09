<?php

namespace Modules\Ecommerce\Entities\Categories;

use Modules\Ecommerce\Entities\Products\Product;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Modules\Ecommerce\Database\factories\CategoryFactory;

class Category extends Model
{
    use NodeTrait, SoftDeletes, HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'cover',
        'is_active',
        'sort_order',
        'parent_id',
        'banner'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->with('attributes:id,quantity,price,sale_price,default,product_id')
            ->select([
                'products.id',
                'products.company_id',
                'products.brand_id',
                'products.sku',
                'products.name',
                'products.description',
                'products.slug',
                'products.cover',
                'products.quantity',
                'products.price',
                'products.sale_price',
                'products.is_visible_on_front',
                'products.sort_order',
                'products.is_active'
            ])
            ->where('products.is_active', 1)
            ->orderBy('sort_order', 'asc');
    }

    public function homeProducts(): belongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->select([
                'products.id',
                'products.name',
                'products.slug',
                'products.cover',
                'products.price',
                'products.sale_price',
                'products.sort_order',
                'products.is_active'
            ])
            ->where('products.is_active', 1)
            ->whereIn('products.sort_order', [1, 2, 3, 4])
            ->orderBy('sort_order', 'asc');
    }

    public function productsForFront(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->with('attributes:id,quantity,product_id')
            ->select([
                'products.id',
                'products.is_active'
            ])
            ->where('products.is_active', 1)
            ->orderBy('sort_order', 'asc');
    }

    public function countProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->select(DB::raw('products.id', 'is_active'))
            ->where('is_active', 1);
    }

    public function productsOrder(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->orderBy('sort_order', 'asc');
    }

    public function productsFilter($select, $totalviews, $take)
    {
        $data = $this->belongsToMany(Product::class)
            ->whereHas('attributes', function (Builder $query) use ($select) {
                $query->whereHas('attributesValues', function (Builder $query) use ($select) {
                    $query->whereIn('value', $select);
                })->where('quantity', '>', 0);
            })->where('is_active', 1)->get();

        return [$data->skip($totalviews)->take($take), $data];
    }
}
