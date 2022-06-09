<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\EconomicActivityTypes\EconomicActivityType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EconomicActivityTypesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        EconomicActivityType::factory()->create([
            'economic_activity_type'  => 'Empleado'
        ]);

        EconomicActivityType::factory()->create([
            'economic_activity_type'  => 'Fuerzas Armadas-Policia'
        ]);

        EconomicActivityType::factory()->create([
            'economic_activity_type'  => 'Prestación de Servicios'
        ]);

        EconomicActivityType::factory()->create([
            'economic_activity_type'  => 'Independiente Certificado'
        ]);

        EconomicActivityType::factory()->create([
            'economic_activity_type'  => 'Independiente NO Certificado'
        ]);

        EconomicActivityType::factory()->create([
            'economic_activity_type'  => 'Rentista'
        ]);

        EconomicActivityType::factory()->create([
            'economic_activity_type'  => 'Pensionado'
        ]);

        EconomicActivityType::factory()->create([
            'economic_activity_type'  => 'Otro'
        ]);
    }
}
