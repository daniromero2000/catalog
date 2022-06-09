<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CustomersDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        $this->call(PermissionsModulesTableSeeder::class);
        $this->call(CustomerGroupTableSeeder::class);
        $this->call(CustomerChannelTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(CustomerStatusesTableSeeder::class);
        $this->call(LeadStatusesTableSeeder::class);
    }
}
