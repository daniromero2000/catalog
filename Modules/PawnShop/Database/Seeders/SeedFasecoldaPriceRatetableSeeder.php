<?php

namespace Modules\PawnShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PawnShop\Entities\FasecoldaPriceRates\FasecoldaPriceRate;

class SeedFasecoldaPriceRatetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        FasecoldaPriceRate::factory()->create([
            'name' => '40%',
            'price' => '0.40'
        ]);
    }
}
