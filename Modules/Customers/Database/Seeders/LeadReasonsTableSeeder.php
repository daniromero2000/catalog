<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Entities\LeadReasons\LeadReason;

class LeadReasonsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        LeadReason::factory()->create([
            'reason'        => 'Beneficios',
            'company_id'    => 1
        ]);

        LeadReason::factory()->create([
            'reason'        => 'Concursos',
            'company_id'    => 1
        ]);

        LeadReason::factory()->create([
            'reason'        => 'Ubicación',
            'company_id'    => 1
        ]);

        LeadReason::factory()->create([
            'reason'        => 'Equipo de Trabajo',
            'company_id'    => 1
        ]);

        LeadReason::factory()->create([
            'reason'        => 'Espacios',
            'company_id'    => 1
        ]);

        LeadReason::factory()->create([
            'reason'        => 'Te identificas con la esencia de Le Femme',
            'company_id'    => 1
        ]);

        LeadReason::factory()->create([
            'reason'        => 'Experiencia de compañía',
            'company_id'    => 1
        ]);

        LeadReason::factory()->create([
            'reason'        => 'No tengo motivo',
            'company_id'    => 1
        ]);
    }
}
