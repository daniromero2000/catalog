<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Housings\Housing;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HousingTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Housing::factory()->create([
            'housing'  => 'Propia'
        ]);

        Housing::factory()->create([
            'housing'  => 'Arrendada'
        ]);

        Housing::factory()->create([
            'housing'  => 'Familiar'
        ]);

        Housing::factory()->create([
            'housing'  => 'Otro'
        ]);
    }
}
