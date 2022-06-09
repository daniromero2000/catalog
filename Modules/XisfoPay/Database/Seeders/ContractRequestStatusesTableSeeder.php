<?php

namespace Modules\XisfoPay\Database\Seeders;

use Modules\XisfoPay\Entities\ContractRequestStatuses\ContractRequestStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ContractRequestStatusesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        ContractRequestStatus::factory()->create([
            'name'  => 'En Revisión'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'Pendiente Archivo'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'En Proceso de Firma'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'En Gestión'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'Aprobado'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'Cerrado'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'Pendiente Información'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'Pendiente Documento Físico'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'Inactivo'
        ]);

        ContractRequestStatus::factory()->create([
            'name'  => 'Firmado'
        ]);
    }
}
