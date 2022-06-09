<?php

namespace Modules\Customers\Database\Seeders;

use Modules\Customers\Entities\CustomerChannels\CustomerChannel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CustomerChannelTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        CustomerChannel::factory()->create([
            'channel'  => 'Facebook'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Whatsapp'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Telemercadeo'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Recontactado'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Almacén'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Buscado'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Adds'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Agencia'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Referencia'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Empleado'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Otro'
        ]);

        CustomerChannel::factory()->create([
            'channel'  => 'Pagina Web'
        ]);
    }
}
