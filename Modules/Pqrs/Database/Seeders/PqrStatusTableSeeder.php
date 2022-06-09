<?php

namespace Modules\Pqrs\Database\Seeders;

use Modules\Pqrs\Entities\PqrStatuses\PqrStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PqrStatusTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        PqrStatus::factory()->create([
            'name'  => 'Atendido',
            'color' => 'green'
        ]);

        PqrStatus::factory()->create([
            'name'  => 'En Tramite',
            'color' => 'yellow'
        ]);

        PqrStatus::factory()->create([
            'name'  => 'Abierto',
            'color' => 'red'
        ]);

        PqrStatus::factory()->create([
            'name'  => 'En Trámite Pendiente Información Tercero',
            'color' => 'grey'
        ]);
    }
}
