<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Generals\Entities\Currencies\Currency;

class CurrencyTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Currency::factory()->create([
            'iso'   => 'USD',
            'name'   => 'US Dollar',
            'symbol' => '$'
        ]);

        Currency::factory()->create([
            'iso'   => 'EUR',
            'name'   => 'Euro',
            'symbol' => '€'
        ]);

        Currency::factory()->create([
            'iso'   => 'COP',
            'name'   => 'Colombian peso',
            'symbol' => '€'
        ]);
    }
}
