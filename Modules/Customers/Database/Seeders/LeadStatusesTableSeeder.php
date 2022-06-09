<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customers\Entities\LeadStatuses\LeadStatus;
use Illuminate\Database\Eloquent\Model;

class LeadStatusesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        LeadStatus::factory()->create([
            'name'  => 'Contactado'
        ]);

        LeadStatus::factory()->create([
            'name'  => 'Sin Decidir'
        ]);

        LeadStatus::factory()->create([
            'name'  => 'Sin Contactar'
        ]);

        LeadStatus::factory()->create([
            'name'  => 'Sin enviar Información'
        ]);

        LeadStatus::factory()->create([
            'name'  => 'Comprometido'
        ]);

        LeadStatus::factory()->create([
            'name'  => 'Re Contactar'
        ]);

        LeadStatus::factory()->create([
            'name'  => 'En Gestión'
        ]);

        LeadStatus::factory()->create([
            'name'  => 'Rechazado'
        ]);

        LeadStatus::factory()->create([
            'name'  => 'Aprobado'
        ]);
    }
}
