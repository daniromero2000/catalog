<?php

namespace Modules\PawnShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PawnShop\Entities\JewelryQualities\JewelryQuality;

class SeedJewelryQualityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        JewelryQuality::factory()->create([
            'name' => 'Italiano',
            'price' => '63000'
        ]);

        JewelryQuality::factory()->create([
            'name' => 'Nacional',
            'price' => '58000'
        ]);

        JewelryQuality::factory()->create([
            'name' => '14 Kilates',
            'price' => '47000'
        ]);

        JewelryQuality::factory()->create([
            'name' => '10 Kilates',
            'price' => '26000'
        ]);

        JewelryQuality::factory()->create([
            'name' => 'plata',
            'price' => '800'
        ]);
    }
}
