<?php

namespace Modules\Banking\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Banking\Entities\Banks\Bank;

class BanksTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Bank::factory()->create([
            'name' => 'Banco de Bogotá', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Popular', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco CorpBanca', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Bancolombia', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Citibank', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco GNB Sudameris', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'BBVA Colombia', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco de Occidente', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Caja Social', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Davivienda', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Scotiabank', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banagrario', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'AV Villas', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Credifinanciera', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Bancamía S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco W S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Bancoomeva', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Finandina', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Falabella S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Pichincha S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Santander', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Mundo Mujer', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Multibank', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco Serfinanzas', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Corficolombiana', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banca de Inversión Bancolombia', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'BNP Paribas', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Giros y Finanzas', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Tuya', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Leasing Bancoldex', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Financiera DANN Regional', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Credifamilia', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'CREZCAMOS', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'FINANCIERA JURISCOOP C.F.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Bancoldex', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Findeter', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Financiera de Desarrollo Nacional S.A', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Finagro', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Icetex', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Fogafin', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Fondo Nacional del Ahorro', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Fogacoop', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Fondo Nacional de Garantías', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Banco de la República', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'CREDIBANCO', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'ACH Colombia S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'MOVII S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'TECNIPAGOS', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Coink S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Grupo Aval Acciones Y Valores S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Grupo De Inversiones Suramericana S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Grupo Bolívar S.A.', 'country_id' => 1, 'is_active' => 1
        ]);

        Bank::factory()->create([
            'name' => 'Cooperativa Médica Del Valle Y De Profesionales De Colombia Coomeva', 'country_id' => 1, 'is_active' => 1
        ]);
    }
}
