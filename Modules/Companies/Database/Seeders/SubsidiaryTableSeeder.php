<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Illuminate\Database\Eloquent\Model;

class SubsidiaryTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Subsidiary::factory()->create([
            'name'          => 'Principal',
            'address'       => 'La 72',
            'phone'         => 3183643,
            'opening_hours' => '8: 00 a 12: 00',
            'city_id'       => 1,
            'company_id'       => 1
        ]);
    }
}
