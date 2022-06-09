<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Scholarities\Scholarity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ScholarityTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Scholarity::factory()->create([
            'scholarity'  => 'Inicial'
        ]);

        Scholarity::factory()->create([
            'scholarity'  => 'Preescolar'
        ]);

        Scholarity::factory()->create([
            'scholarity'  => 'Básica Primaria'
        ]);

        Scholarity::factory()->create([
            'scholarity'  => 'Básica Secundaria'
        ]);

        Scholarity::factory()->create([
            'scholarity'  => 'Media'
        ]);

        Scholarity::factory()->create([
            'scholarity'  => 'Superior'
        ]);
    }
}
