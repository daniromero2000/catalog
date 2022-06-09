<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Categories\Category;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoryProductsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Category::factory()->create()->each(function (Category $category) {
            Product::factory()->make()->each(function (Product $product) use ($category) {
                $category->products()->save($product);
            });
        });
    }
}
