<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Brands\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Brand::factory()->create([
            'name' => 'Tukan'
        ]);
    }
}
