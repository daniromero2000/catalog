<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\CivilStatuses\CivilStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CivilStatusTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        CivilStatus::factory()->create([
            'civil_status'  => 'Casad@'
        ]);

        CivilStatus::factory()->create([
            'civil_status'  => 'Solter@'
        ]);

        CivilStatus::factory()->create([
            'civil_status'  => 'Unión Libre'
        ]);

        CivilStatus::factory()->create([
            'civil_status'  => 'Divorciad@'
        ]);

        CivilStatus::factory()->create([
            'civil_status'  => 'Viud@'
        ]);

        CivilStatus::factory()->create([
            'civil_status'  => 'Otro'
        ]);
    }
}
