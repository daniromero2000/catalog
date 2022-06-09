<?php

namespace Modules\CamStudio\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CamStudioDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(PermissionsModulesTableSeeder::class);
        $this->call(CompaniesRolesTableSeeder::class);
        $this->call(CamModelCategoriesTableSeeder::class);
    }
}
