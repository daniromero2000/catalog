<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $admin = PermissionGroup::factory()->create([
            'name'        => 'Administrativos',
            'group_order' => 4,
            'status'      => 1
        ]);

        $security =   PermissionGroup::factory()->create([
            'name'        => 'Seguridad',
            'group_order' => 7,
            'status'      => 1
        ]);

        $empleados = Permission::factory()->create([
            //id = 1
            'name'                => 'employees',
            'display_name'        => 'Empleados',
            'icon'                => 'fas fa-user-tie',
            'permission_group_id' =>  $admin->id
        ]);

        // Acciones Módulo Empleados
        Action::factory()->create([
            //id = 1
            'permission_id' => $empleados->id,
            'name'          => 'Ver Empleados',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.employees.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 2
            'permission_id' => $empleados->id,
            'name'      => 'Crear Empleado',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.employees.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 3
            'permission_id' => $empleados->id,
            'name'          => 'Editar Empleado',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.employees.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 4
            'permission_id' => $empleados->id,
            'name'          => 'Ver Empleado',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.employees.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 5
            'permission_id' => $empleados->id,
            'name'          => 'Borrar Empleado',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.employees.destroy',
            'principal'     => 0
        ]);

        $employees_profiles = Permission::factory()->create([
            'name'                => 'employees_profiles',
            'display_name'        => 'Perfiles Empleados',
            'icon'                => 'fas fa-user-tie',
            'permission_group_id' =>  $admin->id
        ]);

        Action::factory()->create([
            //id = 4
            'permission_id' => $employees_profiles->id,
            'name'          => 'Ver Perfil Empleado',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.employees-profiles.show',
            'principal'     => 1
        ]);

        $countries =   Permission::factory()->create([
            //id = 2
            'name'                => 'countries',
            'display_name'        => 'Ciudades',
            'icon'                => 'fas fa-city',
            'permission_group_id' =>  $admin->id
        ]);

        // Acciones Módulo Ciudades
        Action::factory()->create([
            //id = 6
            'permission_id' => $countries->id,
            'name'          => 'Ver Ciudades',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.countries.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 7
            'permission_id' => $countries->id,
            'name'          => 'Ver Ciudad',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.countries.show',
            'principal'     => 0
        ]);

        $subsidiaries =  Permission::factory()->create([
            //id = 3
            'name'                => 'subsidiaries',
            'display_name'        => 'Sucursales',
            'icon'                => 'fas fa-map-marker',
            'permission_group_id' =>  $admin->id
        ]);

        // Acciones Módulo Sucursales
        Action::factory()->create([
            //id = 8
            'permission_id' => $subsidiaries->id,
            'name'          => 'Ver Sucursales',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.subsidiaries.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 9
            'permission_id' => $subsidiaries->id,
            'name'          => 'Crear Sucursal',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.subsidiaries.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 10
            'permission_id' => $subsidiaries->id,
            'name'          => 'Editar Sucursal',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.subsidiaries.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 11
            'permission_id' => $subsidiaries->id,
            'name'          => 'Ver Sucursal',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.subsidiaries.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 12
            'permission_id' => $subsidiaries->id,
            'name'          => 'Borrar Sucursal',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.subsidiaries.destroy',
            'principal'     => 0
        ]);

        $roles =    Permission::factory()->create([
            //id = 4
            'name'                => 'roles',
            'display_name'        => 'Roles',
            'icon'                => 'fas fa-user-tag',
            'permission_group_id' =>  $security->id
        ]);


        // Acciones Módulo Roles
        Action::factory()->create([
            //id = 13
            'permission_id' => $roles->id,
            'name'          => 'Ver Roles',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.roles.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 14
            'permission_id' => $roles->id,
            'name'          => 'Crear Rol',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.roles.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 15
            'permission_id' => $roles->id,
            'name'          => 'Ver Rol',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.roles.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 16
            'permission_id' => $roles->id,
            'name'          => 'Borrar Rol',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.roles.destroy',
            'principal'     => 0
        ]);

        $permissions =    Permission::factory()->create([
            //id = 5
            'name'                => 'permissions',
            'display_name'        => 'Permisos',
            'icon'                => 'fas fa-check-double',
            'permission_group_id' =>  $security->id
        ]);

        // Acciones Módulo Permisos
        Action::factory()->create([
            //id = 17
            'permission_id' => $permissions->id,
            'name'          => 'Ver Permisos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.permissions.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 18
            'permission_id' => $permissions->id,
            'name'          => 'Crear Permisos',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.permissions.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 19
            'permission_id' => $permissions->id,
            'name'          => 'Editar Permisos',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.permissions.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 20
            'permission_id' => $permissions->id,
            'name'          => 'Borrar Permiso',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.permissions.destroy',
            'principal'     => 0
        ]);

        $actions =  Permission::factory()->create([
            //id = 10
            'name'                => 'actions',
            'display_name'        => 'Acciones',
            'icon'                => 'fas fa-chalkboard-teacher',
            'permission_group_id' =>  $security->id
        ]);

        // Acciones Módulo Acciones
        Action::factory()->create([
            //id = 39
            'permission_id' => $actions->id,
            'name'          => 'Ver Acciones',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.actions.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 40
            'permission_id' => $actions->id,
            'name'          => 'Crear Acción',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.actions.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 41
            'permission_id' => $actions->id,
            'name'          => 'Editar Acción',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.actions.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 42
            'permission_id' => $actions->id,
            'name'          => 'Borrar Acción',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.actions.destroy',
            'principal'     => 0
        ]);

        $interviews =   Permission::factory()->create([
            //id = 23
            'name'                => 'interviews',
            'display_name'        => 'Entrevistas',
            'icon'                => 'fas fa-address-card',
            'permission_group_id' =>  $admin->id
        ]);

        // Acciones Módulo Entrevistas
        Action::factory()->create([
            //id = 88
            'permission_id' => $interviews->id,
            'name'          => 'Ver Entrevistas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.interviews.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 89
            'permission_id' => $interviews->id,
            'name'      => 'Crear Entrevista',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.interviews.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 90
            'permission_id' => $interviews->id,
            'name'          => 'Editar Entrevista',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.interviews.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 91
            'permission_id' => $interviews->id,
            'name'          => 'Ver Entrevista',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.interviews.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 92
            'permission_id' => $interviews->id,
            'name'          => 'Borrar Entrevista',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.interviews.destroy',
            'principal'     => 0
        ]);

        $interview_statuses =   Permission::factory()->create([
            //id = 24
            'name'                => 'interview_statuses',
            'display_name'        => 'Estados entrevistas',
            'icon'                => 'fas fa-vote-yea',
            'permission_group_id' =>  $admin->id
        ]);

        // Acciones Módulo esstados Entrevistas
        Action::factory()->create([
            //id = 93
            'permission_id' => $interview_statuses->id,
            'name'          => 'Ver Estados Entrevistas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.interview-statuses.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 94
            'permission_id' => $interview_statuses->id,
            'name'      => 'Crear Estado Entrevista',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.interview-statuses.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 95
            'permission_id' => $interview_statuses->id,
            'name'          => 'Editar Estado Entrevista',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.interview-statuses.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 96
            'permission_id' => $interview_statuses->id,
            'name'          => 'Borrar Estado Entrevista',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.interview-statuses.destroy',
            'principal'     => 0
        ]);

        $corporate_phones =  Permission::factory()->create([
            //id = 48
            'name'                => 'corporate_phones',
            'display_name'        => 'Teléfonos Corporativos',
            'icon'                => 'fas fa-funnel-dollar',
            'permission_group_id' =>  $admin->id
        ]);

        // Acciones Módulo Companies Corporate Phones
        Action::factory()->create([
            //id = 193
            'permission_id' => $corporate_phones->id,
            'name'          => 'Ver Teléfonos Corporativos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.corporate-phones.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 194
            'permission_id' => $corporate_phones->id,
            'name'      => 'Crear Teléfonos Corporativos',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.corporate-phones.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 195
            'permission_id' => $corporate_phones->id,
            'name'          => 'Editar Teléfonos Corporativos',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.corporate-phones.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 196
            'permission_id' => $corporate_phones->id,
            'name'          => 'Borrar Teléfonos Corporativos',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.corporate-phones.destroy',
            'principal'     => 0
        ]);

        $goals = Permission::factory()->create([
            //id = 50
            'name'                => 'goals',
            'display_name'        => 'Metas',
            'icon'                => 'fas fa-flag-checkered',
            'permission_group_id' =>  $admin->id
        ]);

        //Acciones Módulo Metas
        Action::factory()->create([
            //id = 204
            'permission_id' => $goals->id,
            'name'          => 'Ver Metas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.goals.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 205
            'permission_id' => $goals->id,
            'name'          => 'Crear Metas',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.goals.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 206
            'permission_id' => $goals->id,
            'name'          => 'Editar Meta',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.goals.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 207
            'permission_id' => $goals->id,
            'name'          => 'Ver Meta',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.goals.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 208
            'permission_id' => $goals->id,
            'name'          => 'Borrar Meta',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.goals.destroy',
            'principal'     => 0
        ]);

        $shifts =   Permission::factory()->create([
            //id = 52
            'name'                => 'shifts',
            'display_name'        => 'Turnos',
            'icon'                => 'fas fa-clock',
            'permission_group_id' =>  $admin->id
        ]);

        //Acciones Módulo Turnos
        Action::factory()->create([
            //id = 214
            'permission_id' => $shifts->id,
            'name'          => 'Ver Turnos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.shifts.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 215
            'permission_id' => $shifts->id,
            'name'          => 'Crear Turnos',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.shifts.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 216
            'permission_id' => $shifts->id,
            'name'          => 'Editar Turno',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.shifts.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 217
            'permission_id' => $shifts->id,
            'name'          => 'Ver Turno',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.shifts.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 218
            'permission_id' => $shifts->id,
            'name'          => 'Borrar Turno',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.shifts.destroy',
            'principal'     => 0
        ]);

        $employees_profiles = Permission::factory()->create([
            //id = 58
            'name'                => 'employees_profiles',
            'display_name'        => 'Perfiles Empleados',
            'icon'                => 'fas fa-check',
            'permission_group_id' =>  $admin->id
        ]);

        //Acciones Módulo Perfiles Empleados
        Action::factory()->create([
            //id = 243
            'permission_id' => $employees_profiles->id,
            'name'          => 'Ver Perfiles Empleados',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.employees-profiles.index',
            'principal'     => 1
        ]);

        $kpis = Permission::factory()->create([
            //id = 60
            'name'                => 'kpis',
            'display_name'        => 'Kpi',
            'icon'                => 'fas fa-chart-line',
            'permission_group_id' =>  $admin->id
        ]);

        //Acciones Módulo Kpi
        Action::factory()->create([
            //id = 234
            'permission_id' => $kpis->id,
            'name'          => 'Ver Kpis',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.kpis.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 235
            'permission_id' => $kpis->id,
            'name'          => 'Crear Kpi',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.kpis.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 236
            'permission_id' => $kpis->id,
            'name'          => 'Editar Kpi',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.kpis.edit',
            'principal'     => 0
        ]);
    }
}
