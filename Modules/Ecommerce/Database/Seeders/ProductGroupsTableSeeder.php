<?php

namespace Modules\Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Ecommerce\Entities\ProductGroups\ProductGroup;

class ProductGroupsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        ProductGroup::factory()->create([
            'name' => 'Outlet',
            'is_active' => 1
        ]);

        ProductGroup::factory()->create([
            'name' => 'Nuevos',
            'is_active' => 1
        ]);

        ProductGroup::factory()->create([
            'name' => 'Más Popular',
            'is_active' => 1
        ]);
    }
}
