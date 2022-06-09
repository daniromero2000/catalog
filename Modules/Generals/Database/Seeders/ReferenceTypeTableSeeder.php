<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\ReferenceTypes\ReferenceType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ReferenceTypeTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        ReferenceType::factory()->create([
            'reference_type'  => 'Familiar'
        ]);

        ReferenceType::factory()->create([
            'reference_type'  => 'Personal'
        ]);

        ReferenceType::factory()->create([
            'reference_type'  => 'Empresarial'
        ]);

        ReferenceType::factory()->create([
            'reference_type'  => 'Codeudor'
        ]);

        ReferenceType::factory()->create([
            'reference_type'  => 'Laboral'
        ]);

        ReferenceType::factory()->create([
            'reference_type'  => 'Otro'
        ]);
    }
}
