<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Stratums\Stratum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StratumsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Stratum::factory()->create([
            'stratum'  => '1',
            'description'  => 'Estrato 1'
        ]);

        Stratum::factory()->create([
            'stratum'  => '2',
            'description'  => 'Estrato 2'
        ]);

        Stratum::factory()->create([
            'stratum'  => '3',
            'description'  => 'Estrato 3'
        ]);

        Stratum::factory()->create([
            'stratum'  => '4',
            'description'  => 'Estrato 4'
        ]);

        Stratum::factory()->create([
            'stratum'  => '5',
            'description'  => 'Estrato 5'
        ]);

        Stratum::factory()->create([
            'stratum'  => '6',
            'description'  => 'Estrato 6'
        ]);

        Stratum::factory()->create([
            'stratum'  => '7',
            'description'  => 'Estrato 7'
        ]);

        Stratum::factory()->create([
            'stratum'  => '8',
            'description'  => 'Estrato 8'
        ]);
    }
}
