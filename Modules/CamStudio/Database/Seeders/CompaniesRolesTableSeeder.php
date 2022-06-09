<?php

namespace Modules\CamStudio\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Roles\Role;

class CompaniesRolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::factory()->create([
            'name'         => 'operative_leader',
            'display_name' => 'Gestor Operativo',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'cam_model',
            'display_name' => 'CamModel',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'studio_manager',
            'display_name' => 'Manager',
            'status'       => 0
        ]);
    }
}
