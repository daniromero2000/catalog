<?php

namespace Modules\Ecommerce\Entities\Checkout;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Ecommerce\Entities\Products\Product;
use Nicolaslopezj\Searchable\SearchableTrait;

class Checkout extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'checkouts';

    protected $fillable = [
        'customer_id'
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
            'customers.name' => 10
        ],
        'joins' => [
            'customers' => ['customers.id', 'checkouts.customer_id']
        ]
    ];

    public function searchCheckouts($term)
    {
        return self::search($term, null, true, true);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTrashed()
            ->withPivot([
                'quantity', 'product_name', 'product_sku', 'product_price',
                'product_attribute_id'
            ]);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }
}
