<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\VehicleTypes\VehicleType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class VehicleTypeTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        VehicleType::factory()->create([
            'vehicle_type'  => 'Automóvil'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Motocicleta'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Avión'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Barco'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Bicicleta'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Bote'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Avioneta'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Submarino'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Camión'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'MotoCarro'
        ]);


        VehicleType::factory()->create([
            'vehicle_type'  => 'Bus'
        ]);


        VehicleType::factory()->create([
            'vehicle_type'  => 'Buseta'
        ]);

        VehicleType::factory()->create([
            'vehicle_type'  => 'Taxi'
        ]);
    }
}
