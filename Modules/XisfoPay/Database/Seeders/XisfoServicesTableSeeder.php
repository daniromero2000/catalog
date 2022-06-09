<?php

namespace Modules\XisfoPay\Database\Seeders;

use Modules\XisfoPay\Entities\XisfoServices\XisfoService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class XisfoServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        XisfoService::factory()->create([
            'name' => 'Soporte'
        ]);

        XisfoService::factory()->create([
            'name' => 'Capacitación'
        ]);

        XisfoService::factory()->create([
            'name' => 'Configuración Plataforma'
        ]);
    }
}
