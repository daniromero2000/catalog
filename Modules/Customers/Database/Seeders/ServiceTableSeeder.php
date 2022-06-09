<?php

namespace Modules\Customers\Database\Seeders;

use Modules\Customers\Entities\Services\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ServiceTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Service::factory()->create([
            'service'  => 'Ecommerce'
        ]);

        Service::factory()->create([
            'service'  => 'XisfoPay'
        ]);

        Service::factory()->create([
            'service'  => 'Lefemme'
        ]);

        Service::factory()->create([
            'service'  => 'LefemmeCams'
        ]);

        Service::factory()->create([
            'service'  => 'Tu Agencia Webcam'
        ]);

        Service::factory()->create([
            'service'  => 'Otro'
        ]);
    }
}
