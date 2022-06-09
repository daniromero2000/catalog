<?php

namespace Modules\Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EcommerceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(PermissionsModulesTableSeeder::class);
        $this->call(CompaniesRolesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(ProductGroupsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CourierTableSeeder::class);
        $this->call(OrderStatusTableSeeder::class);
        $this->call(AttributeTableSeeder::class);
    }
}
