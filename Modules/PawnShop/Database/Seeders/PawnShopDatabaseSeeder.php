<?php

namespace Modules\PawnShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PawnShopDatabaseSeeder extends Seeder
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
        $this->call(SeedFasecoldaPriceRatetableSeeder::class);
        $this->call(SeedJewelryQualityTableSeeder::class);
        $this->call(SeedPawnItemCategoryTableSeeder::class);
        $this->call(SeedPawnItemStatusTableSeeder::class);
    }
}
