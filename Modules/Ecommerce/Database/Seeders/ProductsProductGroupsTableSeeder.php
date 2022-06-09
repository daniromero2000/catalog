<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Ecommerce\Entities\ProductGroups\ProductGroup;

class ProductsProductGroupsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Product::factory()->create()->each(function (Product $product) {
            ProductGroup::factory()->make()->each(function (Product $ProductGroup) use ($product) {
                $product->productGroups()->save($ProductGroup);
            });
        });
    }
}
