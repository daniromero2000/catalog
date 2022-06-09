<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class EmployeePositionsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        EmployeePosition::factory()->create([
            'position' => 'Asesor',
            'department_id' => 9
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Promotor',
            'department_id' => 9
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Gerente Comercial',
            'department_id' => 2
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Gerente Financiero',
            'department_id' => 2
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Gerente General',
            'department_id' => 2
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Contador',
            'department_id' => 3
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Manager',
            'department_id' => 2
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Modelo',
            'department_id' => 9
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Desarrollador',
            'department_id' => 6
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Community Manager',
            'department_id' => 5
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Diseñador@',
            'department_id' => 5
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Jefe de Mantenimiento',
            'department_id' => 11
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Auxiliar de Mantenimiento',
            'department_id' => 11
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Auxiliar Administrativa',
            'department_id' => 2
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Auxiliar Contable',
            'department_id' => 3
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Lider de Mercadeo',
            'department_id' => 5
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Fotograf@',
            'department_id' => 5
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Audiovisuales@',
            'department_id' => 5
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Lider de Desarrollo',
            'department_id' => 6
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Gestor Operativo',
            'department_id' => 9
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Gestor Comercial',
            'department_id' => 9
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Administrador Sede',
            'department_id' => 2
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Auxiliar de Mercadeo',
            'department_id' => 5
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Gerente Administrativo',
            'department_id' => 2
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Director Nacional',
            'department_id' => 2
        ]);

        EmployeePosition::factory()->create([
            'position' => 'Líder de Procesos',
            'department_id' => 2
        ]);
    }
}
