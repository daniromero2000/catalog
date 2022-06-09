<?php

namespace Modules\XisfoPay\Database\Seeders;

use Modules\XisfoPay\Entities\ContractRates\ContractRate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ContractRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        ContractRate::factory()->create([
            'percentage' => '5%',
            'type'       => 0,
            'value'      => 0.05,
            'is_aprobed' => 1,
            'is_active'  => 1
        ]);

        ContractRate::factory()->create([
            'percentage' => '3.9%',
            'type'       => 0,
            'value'      => 0.039,
            'is_aprobed' => 1,
            'is_active'  => 1
        ]);

        ContractRate::factory()->create([
            'percentage' => 'Tokens',
            'type'       => 0,
            'value'      => 200.00,
            'is_aprobed' => 1,
            'is_active'  => 1
        ]);
    }
}
