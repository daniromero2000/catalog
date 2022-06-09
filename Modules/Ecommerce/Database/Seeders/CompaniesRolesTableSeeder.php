<?php

namespace Modules\Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Roles\Role;

class CompaniesRolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::factory()->create([
            'name'          => 'ecommerce_admin',
            'display_name'  => 'Admin Ecommerce'
        ]);
    }
}
