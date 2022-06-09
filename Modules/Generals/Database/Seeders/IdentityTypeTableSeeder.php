<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\IdentityTypes\IdentityType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class IdentityTypeTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        IdentityType::factory()->create([
            'identity_type' => 'Cédula de Ciudadanía',
            'initials'      => 'CC'

        ]);

        IdentityType::factory()->create([
            'identity_type' => 'Tarjeta de Identidad',
            'initials'      => 'TI'
        ]);

        IdentityType::factory()->create([
            'identity_type' => 'Pasaporte',
            'initials'      => 'Pasaporte'
        ]);

        IdentityType::factory()->create([
            'identity_type' => 'Cédula de Extranjería',
            'initials'      => 'CE'
        ]);

        IdentityType::factory()->create([
            'identity_type' => 'NIT',
            'initials'      => 'NIT'
        ]);

        IdentityType::factory()->create([
            'identity_type' => 'RUT',
            'initials'      => 'RUT'
        ]);
    }
}
