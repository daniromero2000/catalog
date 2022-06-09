<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\InterviewStatuses\InterviewStatus;

class InterviewStatusesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        InterviewStatus::factory()->create([
            'name' => 'Contactado',
            'color' => 'green'
        ]);

        InterviewStatus::factory()->create([
            'name' => 'Pendiente',
            'color' => 'yellow'
        ]);

        InterviewStatus::factory()->create([
            'name' => 'Rechazado',
            'color' => 'red'
        ]);

        InterviewStatus::factory()->create([
            'name' => 'En proceso',
            'color' => 'blue'
        ]);

        InterviewStatus::factory()->create([
            'name' => 'Contratado',
            'color' => 'violet'
        ]);
    }
}
