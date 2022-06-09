<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Provinces\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MyProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Province::factory()->create([
            'dane'       => '05',
            'province'   => 'Antioquia',
            'prefix'     => '034',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '08',
            'province'        => 'Atlántico',
            'prefix'     => '035',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '11',
            'province'        => 'Bogotá',
            'prefix'     => '031',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '13',
            'province'        => 'Bolivar',
            'prefix'     => '035',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '15',
            'province'        => 'Boyacá',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '17',
            'province'        => 'Caldas',
            'prefix'     => '036',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '18',
            'province'        => 'Caquetá',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '19',
            'province'        => 'Cauca',
            'prefix'     => '032',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '20',
            'province'        => 'Cesar',
            'prefix'     => '035',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '23',
            'province'        => 'Córdoba',
            'prefix'     => '034',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '25',
            'province'        => 'Cundinamarca',
            'prefix'     => '031',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '27',
            'province'        => 'Chocó',
            'prefix'     => '034',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '41',
            'province'        => 'Huila',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '44',
            'province'        => 'La Guajira',
            'prefix'     => '035',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '47',
            'province'        => 'Magdalena',
            'prefix'     => '035',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '50',
            'province'        => 'Meta',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '52',
            'province'        => 'Nariño',
            'prefix'     => '032',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '54',
            'province'        => 'Norte de Santander',
            'prefix'     => '037',
            'country_id' => '1'
        ]);


        Province::factory()->create([
            'dane'        => '63',
            'province'        => 'Quindío',
            'prefix'     => '036',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '66',
            'province'        => 'Risaralda',
            'prefix'     => '036',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '68',
            'province'        => 'Santander',
            'prefix'     => '037',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '70',
            'province'        => 'Sucre',
            'prefix'     => '035',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '73',
            'province'        => 'Tolima',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '76',
            'province'        => 'Valle del Cauca',
            'prefix'     => '032',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '81',
            'province'        => 'Arauca',
            'prefix'     => '037',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '85',
            'province'        => 'Casanare',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '86',
            'province'        => 'Putumayo',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '88',
            'province'        => 'San Andrés',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '91',
            'province'        => 'Amazonas',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '94',
            'province'        => 'Guainía',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '95',
            'province'        => 'Guaviare',
            'prefix'     => '035',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '97',
            'province'        => 'Vaupes',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'dane'        => '99',
            'province'        => 'Vichada',
            'prefix'     => '038',
            'country_id' => '1'
        ]);

        Province::factory()->create([
            'province' => 'Amazonas',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' => 'Anzoátegui',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' => 'Apure',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' => 'Aragua',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' => 'Barinas',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' => 'Bolívar',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' => 'Carabobo',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' => 'Cojedes',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' => 'Delta Amacuro',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Falcón',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Guárico',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Lara',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Mérida',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Miranda',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Monagas',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Nueva Esparta',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Portuguesa',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Sucre',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Táchira',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Trujillo',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Vargas',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Yaracuy',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Zulia',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Distrito Capital',
            'prefix'     => '0',
            'country_id' => '231'
        ]);

        Province::factory()->create([
            'province' =>  'Dependencias Federales',
            'prefix'     => '0',
            'country_id' => '231'
        ]);
    }
}
