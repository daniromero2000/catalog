<?php

namespace Modules\XisfoPay\Database\Seeders;

use Modules\XisfoPay\Entities\PaymentRequestStatuses\PaymentRequestStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PaymentRequestStatusesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        PaymentRequestStatus::factory()->create([
            'name'  => 'En Revisión'
        ]);

        PaymentRequestStatus::factory()->create([
            'name'  => 'Pendiente Archivo'
        ]);

        PaymentRequestStatus::factory()->create([
            'name'  => 'Pendiente Firma'
        ]);

        PaymentRequestStatus::factory()->create([
            'name'  => 'En Gestión'
        ]);

        PaymentRequestStatus::factory()->create([
            'name'  => 'Aprobado'
        ]);

        PaymentRequestStatus::factory()->create([
            'name'  => 'Cerrado'
        ]);

        PaymentRequestStatus::factory()->create([
            'name'  => 'En Transferencia'
        ]);

        PaymentRequestStatus::factory()->create([
            'name'  => 'Transferido'
        ]);
    }
}
