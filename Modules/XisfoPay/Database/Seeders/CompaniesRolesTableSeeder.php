<?php

namespace Modules\XisfoPay\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Roles\Role;

class CompaniesRolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::factory()->create([
            'name'         => 'xisfopay_assistant',
            'display_name' => 'Auxiliar XisfoPay',
            'status'       => 0
        ]);

        Role::factory()->create([
            'name'         => 'xisfopay_comercial',
            'display_name' => 'Comercial XisfoPay',
            'status'       => 0
        ]);
    }
}
