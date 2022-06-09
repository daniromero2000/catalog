<?php

namespace Modules\Pqrs\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $pqr =   PermissionGroup::factory()->create([
            'name'        => 'Pqrs',
            'group_order' => 3,
            'status'      => 1
        ]);

        $pqrs =   Permission::factory()->create([
            //id = 6
            'name'                => 'pqrs',
            'display_name'        => 'PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' =>  $pqr->id
        ]);

        // Acciones Módulo PQRs
        Action::factory()->create([
            //id = 21
            'permission_id' => $pqrs->id,
            'name'          => 'Ver PQR´s',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.pqrsdashboard',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 22
            'permission_id' => $pqrs->id,
            'name'          => 'Crear PQR´s',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.pqrs.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 23
            'permission_id' => $pqrs->id,
            'name'          => 'Editar PQR´s',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.pqrs.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 24
            'permission_id' => $pqrs->id,
            'name'          => 'Ver PQR´s',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.pqrs.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 25
            'permission_id' => $pqrs->id,
            'name'          => 'Borrar PQR´s',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.pqrs.destroy',
            'principal'     => 0
        ]);

        $pqrs_statuses =    Permission::factory()->create([
            //id = 7
            'name'                => 'pqrs_statuses',
            'display_name'        => 'Estados PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' =>  $pqr->id
        ]);

        // Acciones Módulo PQRs
        Action::factory()->create([
            //id = 26
            'permission_id' => $pqrs_statuses->id,
            'name'          => 'Ver Estados PQR´s',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.pqr-statuses.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 27
            'permission_id' => $pqrs_statuses->id,
            'name'          => 'Crear Estado PQR',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.pqr-statuses.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 28
            'permission_id' => $pqrs_statuses->id,
            'name'          => 'Editar Estado PQR',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.pqr-statuses.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 29
            'permission_id' => $pqrs_statuses->id,
            'name'          => 'Borrar Estado PQR',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.pqr-statuses.destroy',
            'principal'     => 0
        ]);
    }
}
