<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Relationships\Relationship;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RelationshipTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Relationship::factory()->create([
            'relationship'  => 'Madre',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Padre',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Herman@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Ti@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Abuel@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Cónyuge',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Prim@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Amig@',
            'reference_type_id' => 2
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Hij@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Yern@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Sobrin@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Cuñad@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Suegr@',
            'reference_type_id' => 1
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Administrador',
            'reference_type_id' => 3
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Contador',
            'reference_type_id' => 3
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Representante Legal',
            'reference_type_id' => 3
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Jefe',
            'reference_type_id' => 5
        ]);

        Relationship::factory()->create([
            'relationship'  => 'Socio',
            'reference_type_id' => 5
        ]);
    }
}
