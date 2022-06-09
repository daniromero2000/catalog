<?php

namespace Modules\Fasecolda\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $fasecolda = PermissionGroup::factory()->create([
            'name'        => 'Fasecolda',
            'group_order' => 4,
            'status'      => 1
        ]);

        $fasecolda_codes =   Permission::factory()->create([
            'name'                => 'fasecolda',
            'display_name'        => 'Fasecolda',
            'icon'                => 'fas fa-university',
            'permission_group_id' =>  $fasecolda->id
        ]);

        // Acciones Módulo Bancos
        Action::factory()->create([
            'permission_id' => $fasecolda_codes->id,
            'name'          => 'Ver Códigos Fasecolda',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.fasecolda-codes.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $fasecolda_codes->id,
            'name'      => 'Cargar Códigos Fasecolda',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.fasecolda-codes.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            'permission_id' => $fasecolda_codes->id,
            'name'      => 'Cargar Valores Fasecolda',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.fasecolda-prices.create',
            'principal' => 1
        ]);
    }
}
