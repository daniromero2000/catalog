<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Roles\Role;

class CompaniesRolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::factory()->create([
            'name'         => 'superadmin',
            'display_name' => 'Super Admin',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'no_access',
            'display_name' => 'Sin Acceso'
        ]);

        Role::factory()->create([
            'name'         => 'rh',
            'display_name' => 'Recursos Humanos',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'admin',
            'display_name' => 'Administrador',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'accounting_assistant',
            'display_name' => 'Auxiliar Contable',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'community_manager',
            'display_name' => 'Community Manager',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'marketing_leader',
            'display_name' => 'Lider Mercadeo',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'financial',
            'display_name' => 'Financiero',
            'status'       => 0
        ]);
    }
}
