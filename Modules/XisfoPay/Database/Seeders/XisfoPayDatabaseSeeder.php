<?php

namespace Modules\XisfoPay\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class XisfoPayDatabaseSeeder extends Seeder
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
        $this->call(ContractStatusesTableSeeder::class);
        $this->call(ContractRequestStatusesTableSeeder::class);
        $this->call(PaymentRequestStatusesTableSeeder::class);
        $this->call(ContractRatesTableSeeder::class);
        $this->call(XisfoServicesTableSeeder::class);
    }
}
