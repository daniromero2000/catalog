<?php

namespace Modules\PawnShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PawnShop\Entities\PawnItemCategories\PawnItemCategory;

class SeedPawnItemCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        PawnItemCategory::factory()->create([
            'name' => 'Joyería'
        ]);

        PawnItemCategory::factory()->create([
            'name' => 'Vehículos'
        ]);

        PawnItemCategory::factory()->create([
            'name' => 'Electrodomésticos'
        ]);

        PawnItemCategory::factory()->create([
            'name' => 'Bicicletas'
        ]);

        PawnItemCategory::factory()->create([
            'name' => 'Video juegos'
        ]);

        PawnItemCategory::factory()->create([
            'name' => 'Instrumentos musicales'
        ]);

        PawnItemCategory::factory()->create([
            'name' => 'Herramientas'
        ]);

        PawnItemCategory::factory(ItemCategory::class)->create([
            'name' => 'Otros'
        ]);
    }
}
