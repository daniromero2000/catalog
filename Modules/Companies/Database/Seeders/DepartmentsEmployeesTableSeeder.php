<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\DepartmentsEmployees\DepartmentEmployee;

class DepartmentsEmployeesTableSeeder extends Seeder
{

    public function run()
    {
        DepartmentEmployee::factory()->create([
            'department_id' => '1',
            'employee_id' => '1'
        ]);
    }
}
