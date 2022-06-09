<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Departments\Department;
use Illuminate\Database\Eloquent\Model;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Department::factory()->create([
            'name' => 'Recursos Humanos'
        ]);

        Department::factory()->create([
            'name' => 'Dirección Administrativa'
        ]);

        Department::factory()->create([
            'name' => 'Contabilidad y Finanzas'
        ]);

        Department::factory()->create([
            'name' => 'Producción'
        ]);

        Department::factory()->create([
            'name' => 'Marketing Y Publicidad'
        ]);

        Department::factory()->create([
            'name' => 'Tecnologías de la Información'
        ]);

        Department::factory()->create([
            'name' => 'Servicio al Cliente'
        ]);

        Department::factory()->create([
            'name' => 'Compras'
        ]);

        Department::factory()->create([
            'name' => 'Comercial'
        ]);

        Department::factory()->create([
            'name' => 'Desarrollo'
        ]);

        Department::factory()->create([
            'name' => 'Mantenimiento'
        ]);
    }
}
