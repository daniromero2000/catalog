<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OrderStatusTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        OrderStatus::factory()->create([
            'name' => 'Pagado',
            'color' => 'green'
        ]);

        OrderStatus::factory()->create([
            'name' => 'Pendiente',
            'color' => 'yellow'
        ]);

        OrderStatus::factory()->create([
            'name' => 'error',
            'color' => 'red'
        ]);

        OrderStatus::factory()->create([
            'name' => 'En entrega',
            'color' => 'blue'
        ]);

        OrderStatus::factory()->create([
            'name' => 'Ordenado',
            'color' => 'violet'
        ]);
    }
}
