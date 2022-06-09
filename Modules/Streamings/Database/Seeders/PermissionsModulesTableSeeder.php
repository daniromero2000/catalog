<?php

namespace Modules\Streamings\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $streaming = PermissionGroup::factory()->create([
            'name'        => 'Streaming',
            'group_order' => 4,
            'status'      => 1
        ]);

        $streamings =  Permission::factory()->create([
            //id = 41
            'name'                => 'streamings',
            'display_name'        => 'Streamings',
            'icon'                => 'fas fa-cut',
            'permission_group_id' =>  $streaming->id
        ]);

        // Acciones Módulo Streamings
        Action::factory()->create([
            //id = 166
            'permission_id' => $streamings->id,
            'name'          => 'Ver Streamings',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.streamings.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 167
            'permission_id' => $streamings->id,
            'name'      => 'Crear Streaming',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.streamings.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 168
            'permission_id' => $streamings->id,
            'name'          => 'Editar Streaming',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.streamings.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 169
            'permission_id' => $streamings->id,
            'name'          => 'Borrar Streaming',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.streamings.destroy',
            'principal'     => 0
        ]);
    }
}
