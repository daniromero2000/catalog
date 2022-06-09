<?php

namespace Modules\Ecommerce\Entities\ProductGroups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Database\factories\ProductGroupFactory;
use Modules\Ecommerce\Entities\Products\Product;

class ProductGroup extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'product_groups';

    protected $fillable = [];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return ProductGroupFactory::new();
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
