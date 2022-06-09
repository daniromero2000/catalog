<?php

namespace Modules\PawnShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PawnShop\Entities\FasecoldaPrices\FasecoldaPriceValue;

class FasecoldaPriceValueTableSeeder extends Seeder
{
    public function run()
    {
        FasecoldaPriceValue::factory()->create([
            'name' => '40%',
            'price' => '0.40'
        ]);
    }
}
