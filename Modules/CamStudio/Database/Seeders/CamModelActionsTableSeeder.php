<?php

namespace Modules\CamStudio\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\ActionRole\ActionRole;

class CamModelActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Permisos Accion Módulo modelos perfil modelo
        ActionRole::factory()->create([
            'action_id' => 93,
            'role_id' => 12
        ]);
    }
}
