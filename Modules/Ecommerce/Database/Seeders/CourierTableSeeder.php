<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Couriers\Courier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CourierTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Courier::factory()->create([
            'name' => 'Envío Gratis',
            'description' => 'Envío Gratis',
            'is_free' => 1,
            'cost' => 0
        ]);

        Courier::factory()->create([
            'name' => 'Regional',
            'description' => 'Envío Eje Cafetero',
            'is_free' => 0,
            'cost' => 7000
        ]);

        Courier::factory()->create([
            'name' => 'Nacional',
            'description' => 'Envío Nacional',
            'is_free' => 0,
            'cost' => 9000
        ]);

        Courier::factory()->create([
            'name' => 'Contra Entrega',
            'description' => 'Contra Entrega',
            'is_free' => 0,
            'cost' => 0
        ]);
    }
}
