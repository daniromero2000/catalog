<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Companies\Company;
use Illuminate\Database\Eloquent\Model;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        Company::factory()->create([
            'name'  => 'SmartCommerce',
            'country_id' => 1,
            'currency_id' => 3,
            'identification' => 123,
            'company_type' => 'Jurídica'
        ]);
    }
}
