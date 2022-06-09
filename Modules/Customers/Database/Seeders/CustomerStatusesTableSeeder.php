<?php

namespace Modules\Customers\Database\Seeders;

use Modules\Customers\Entities\CustomerStatuses\CustomerStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CustomerStatusesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        CustomerStatus::factory()->create([
            'name'  => 'Contactado',
            'color' => 'green'
        ]);

        CustomerStatus::factory()->create([
            'name'  => 'Sin Decidir',
            'color' => 'yellow'
        ]);

        CustomerStatus::factory()->create([
            'name'  => 'Sin Contactar',
            'color' => 'red'
        ]);

        CustomerStatus::factory()->create([
            'name'  => 'Sin enviar Información',
            'color' => 'blue'
        ]);

        CustomerStatus::factory()->create([
            'name'  => 'Comprometido',
            'color' => 'grey'
        ]);

        CustomerStatus::factory()->create([
            'name'  => 'Re Contactar',
            'color' => 'orange'
        ]);

        CustomerStatus::factory()->create([
            'name'  => 'En Gestión',
            'color' => 'orange'
        ]);

        CustomerStatus::factory()->create([
            'name'  => 'Rechazado',
            'color' => 'orange'
        ]);

        CustomerStatus::factory()->create([
            'name'  => 'Aprobado',
            'color' => 'orange'
        ]);
    }
}
