<?php

namespace Modules\Ecommerce\Entities\Wishlists;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Wishlist extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'wishlists';

    protected $fillable = [
        'product_id',
        'customer_id',
        'moved_to_cart',
        'shared',
        'time_of_moving'
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
            'customers.name' => 10,
            'wishlists.id'   => 10
        ],
        'joins' => [
            'customers' => ['customers.id', 'wishlists.customer_id']
        ]
    ];

    public function searchWishlists($term)
    {
        return self::search($term, null, true, true);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->withTrashed()
            ->select(['id', 'name', 'sku', 'price', 'is_active']);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->select(['id', 'name', 'last_name']);
    }
}
