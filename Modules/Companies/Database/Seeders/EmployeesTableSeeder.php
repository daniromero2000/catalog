<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Permissions\Permission;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        /*Creacion Usuario Super Admin Desarrollo*/
        $employee          =  Employee::factory()->create([
            'email'        => 'desarrollo@smartcommerce.com.co'
        ]);

        $super         = Role::find(1);
        $permissions   = Permission::pluck('id')->all();
        $roleSuperRepo = new RoleRepository($super);
        $roleSuperRepo->syncPermissions($permissions);
        $employee->roles()->save($super);
    }
}
