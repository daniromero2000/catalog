<?php

namespace Modules\Banking\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BankingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(BanksTableSeeder::class);
        $this->call(PermissionsModulesTableSeeder::class);
    }
}
