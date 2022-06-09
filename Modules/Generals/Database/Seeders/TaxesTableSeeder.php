<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Generals\Entities\Taxes\Tax;

class TaxesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Tax::factory()->create([
            'name' => 'Iva',
            'value' => 0.19,
            'country_id' => 1
        ]);
    }
}
