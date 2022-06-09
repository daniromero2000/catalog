<?php

namespace Modules\Banking\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $bancos = PermissionGroup::factory()->create([
            'name'        => 'Banca',
            'group_order' => 4,
            'status'      => 1
        ]);

        $banks =   Permission::factory()->create([
            'name'                => 'banks',
            'display_name'        => 'Bancos',
            'icon'                => 'fas fa-university',
            'permission_group_id' =>  $bancos->id
        ]);

        // Acciones Módulo Bancos
        Action::factory()->create([
            'permission_id' => $banks->id,
            'name'          => 'Ver Bancos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.banks.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            'permission_id' => $banks->id,
            'name'      => 'Crear Banco',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.banks.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            'permission_id' => $banks->id,
            'name'          => 'Editar Banco',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.banks.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            'permission_id' => $banks->id,
            'name'          => 'Borrar Banco',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.banks.destroy',
            'principal'     => 0
        ]);
    }
}
