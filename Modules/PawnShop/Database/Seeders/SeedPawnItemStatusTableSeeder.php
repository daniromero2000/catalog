<?php

namespace Modules\PawnShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PawnShop\Entities\PawnItemStatuses\PawnItemStatus;

class SeedPawnItemStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        PawnItemStatus::factory()->create([
            'name'  => 'Finalizado',
            'color' => 'green'
        ]);

        PawnItemStatus::factory()->create([
            'name'  => 'Valorado',
            'color' => 'grey'
        ]);

        PawnItemStatus::factory()->create([
            'name'  => 'Sin Gestionar',
            'color' => 'red'
        ]);

        PawnItemStatus::factory()->create([
            'name'  => 'Desistido',
            'color' => 'blue'
        ]);
    }
}
