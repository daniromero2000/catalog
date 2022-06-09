<?php

namespace Modules\XisfoPay\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\XisfoPay\Entities\ContractStatuses\ContractStatus;

class ContractStatusesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        ContractStatus::factory()->create([
            'name'  => 'En Revisión'
        ]);

        ContractStatus::factory()->create([
            'name'  => 'Pendiente Documento Físico'
        ]);

        ContractStatus::factory()->create([
            'name'  => 'En Proceso de Firma'
        ]);

        ContractStatus::factory()->create([
            'name'  => 'Aprobado'
        ]);

        ContractStatus::factory()->create([
            'name'  => 'No Vigente'
        ]);

        ContractStatus::factory()->create([
            'name'  => 'Proceso de Renovación'
        ]);

        ContractStatus::factory()->create([
            'name'  => 'Renovado'
        ]);

        ContractStatus::factory()->create([
            'name'  => 'Firmado'
        ]);
    }
}
