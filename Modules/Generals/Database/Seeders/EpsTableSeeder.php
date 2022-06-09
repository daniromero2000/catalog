<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Epss\Eps;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EpsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Eps::factory()->create([
            'eps' => 'ALIANSALUD EPS'
        ]);
        Eps::factory()->create([
            'eps' => 'ASMET SALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'ASOCIACIÓN DE CABILDOS INDÍGENAS DEL CESAR “DUSAKAWI” '
        ]);
        Eps::factory()->create([
            'eps' => 'ASOCIACIÓN DE CABILDOS INDÍGENAS DEL RESGUARDO INDÍGENA ZENÚ DE SAN ANDRÉS DE SOTAVENTO CÓRDOBA - SUCRE "MANEXKA"'
        ]);
        Eps::factory()->create([
            'eps' => 'ASOCIACIÓN INDÍGENA DEL CAUCA - A.I.C.'
        ]);
        Eps::factory()->create([
            'eps' => 'ASOCIACIÓN MUTUAL BARRIOS UNIDOS DE QUIBDÓ E.S.S. AMBUQ'
        ]);
        Eps::factory()->create([
            'eps' => 'ASOCIACIÓN MUTUAL EMPRESA SOLIDARIA DE SALUD DE NARIÑO E.S.S. EMSSANAR E.S.S.'
        ]);
        Eps::factory()->create([
            'eps' => 'ASOCIACIÓN MUTUAL LA ESPERANZA ASMET SALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'ASOCIACIÓN MUTUAL SER EMPRESA SOLIDARÍA DE SALUD ESS'
        ]);
        Eps::factory()->create([
            'eps' => 'BARRANQUILLA SANA'
        ]);
        Eps::factory()->create([
            'eps' => 'BONSALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'CAFESALUD ENTIDAD  PROMOTORA DE SALUD S.A'
        ]);
        Eps::factory()->create([
            'eps' => 'CAFESALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'CAJA DE COMPENSACIÓN FAMILIAR DE ANTIOQUÍA - COMFAMA - HOY SAVIA SALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'CAJA DE COMPENSACIÓN FAMILIAR DE LA GUAJIRA'
        ]);
        Eps::factory()->create([
            'eps' => 'CAJA DE COMPENSACION FAMILIAR DEL HUILA'
        ]);
        Eps::factory()->create([
            'eps' => 'CAJACOPI ATLÁNTICO  - CCF'
        ]);
        Eps::factory()->create([
            'eps' => 'CAJANAL'
        ]);
        Eps::factory()->create([
            'eps' => 'CALDAS'
        ]);
        Eps::factory()->create([
            'eps' => 'CALISALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'CAPITAL SALUD S.A.S.'
        ]);
        Eps::factory()->create([
            'eps' => 'CAPRECOM'
        ]);
        Eps::factory()->create([
            'eps' => 'CAPRESOCA'
        ]);
        Eps::factory()->create([
            'eps' => 'COLMENA ARP'
        ]);
        Eps::factory()->create([
            'eps' => 'COLSEGUROS'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFABOY EPS-CCF DE BOYACÁ'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFACHOCO – CCF DEL CHOCÓ'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFACOR EPS – CCF DE CÓRDOBA'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFACUNDI - CCF DE CUNDINAMARCA'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFAMILIAR DE NARIÑO EPS – CCF'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFAMILIAR HUILA EPS – CCF'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFASUCRE EPS-CCF DE SUCRE'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFENALCO VALLE EPS'
        ]);
        Eps::factory()->create([
            'eps' => 'COMFENALDO ANTIOQUIA'
        ]);
        Eps::factory()->create([
            'eps' => 'COMPENSAR ENTIDAD PROMOTORA DE SALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'CONDOR'
        ]);
        Eps::factory()->create([
            'eps' => 'CONVIDA'
        ]);
        Eps::factory()->create([
            'eps' => 'COOMEVA'
        ]);
        Eps::factory()->create([
            'eps' => 'COOPERATIVA DE SALUD COMUNITARIA COMPARTA'
        ]);
        Eps::factory()->create([
            'eps' => 'COOPERATIVA DE SALUD Y DESARROLLO INTEGRAL DE LA ZONA SUR ORIENTAL DE CARTAGENA  B ALTDA.  COOSALUD E.S.S.'
        ]);
        Eps::factory()->create([
            'eps' => 'COOSALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'CORPORANONIMAS'
        ]);
        Eps::factory()->create([
            'eps' => 'COSMITET'
        ]);
        Eps::factory()->create([
            'eps' => 'CRUZ BLANCA S.A'
        ]);
        Eps::factory()->create([
            'eps' => 'SANITAS'
        ]);
        Eps::factory()->create([
            'eps' => 'EMPRESA MUTUAL PARA EL DESARROLLO INTEGRAL DE LA SALUD E.S.S. EMDISALUD ESS'
        ]);
        Eps::factory()->create([
            'eps' => 'EMPRESAS PÚBLICAS DE MEDELLÍN DEPARTAMENTO MÉDICO'
        ]);
        Eps::factory()->create([
            'eps' => 'EMSSANAR'
        ]);
        Eps::factory()->create([
            'eps' => 'ENTIDAD ADMINISTRADORA DE RÉGIMEN SUBSIDIADO CONVIDA'
        ]);
        Eps::factory()->create([
            'eps' => 'ENTIDAD COOPERATIVA SOLIDARIA DE SALUD ECOOPSOS'
        ]);
        Eps::factory()->create([
            'eps' => 'ENTIDAD PROMOTORA DE SALUD ANAS WAYUU EPSI'
        ]);
        Eps::factory()->create([
            'eps' => 'ENTIDAD PROMOTORA DE SALUD MALLAMAS EPSI'
        ]);
        Eps::factory()->create([
            'eps' => 'ENTIDAD PROMOTORA DE SALUD PIJAOSALUD EPSI'
        ]);
        Eps::factory()->create([
            'eps' => 'FAMEDIC SAS'
        ]);
        Eps::factory()->create([
            'eps' => 'FAMISANAR'
        ]);
        Eps::factory()->create([
            'eps' => 'FONDO DE PASIVO SOCIAL DE FERROCARRILES'
        ]);
        Eps::factory()->create([
            'eps' => 'FONDO DE SOLIDARIDAD Y GARANTÍA FOSYGA'
        ]);
        Eps::factory()->create([
            'eps' => 'FOSYGA'
        ]);
        Eps::factory()->create([
            'eps' => 'HUMANA VIVIR'
        ]);
        Eps::factory()->create([
            'eps' => 'MEDIMAS S.A.S.'
        ]);
        Eps::factory()->create([
            'eps' => 'METROP. DE SALUD'
        ]);
        Eps::factory()->create([
            'eps' => 'MUTUAL SER'
        ]);
        Eps::factory()->create([
            'eps' => 'NUEVA EPS'
        ]);
        Eps::factory()->create([
            'eps' => 'POSITIVA'
        ]);
        Eps::factory()->create([
            'eps' => 'PROFAMILIA'
        ]);
        Eps::factory()->create([
            'eps' => 'RED SALUD ATENCIÓN HUMANA'
        ]);
        Eps::factory()->create([
            'eps' => 'RISARALDA'
        ]);
        Eps::factory()->create([
            'eps' => 'SALUD COLOMBIA'
        ]);
        Eps::factory()->create([
            'eps' => 'SALUD COLPATRIA'
        ]);
        Eps::factory()->create([
            'eps' => 'SALUD TOTAL S.A.'
        ]);
        Eps::factory()->create([
            'eps' => 'SALUDVIDA S.A'
        ]);
        Eps::factory()->create([
            'eps' => 'SANITAS S.A.'
        ]);
        Eps::factory()->create([
            'eps' => 'SELVASALUD S.A.'
        ]);
        Eps::factory()->create([
            'eps' => 'SERVICIO OCCIDENTAL DE SALUD S.A. S.O.S'
        ]);
        Eps::factory()->create([
            'eps' => 'SOAT'
        ]);
        Eps::factory()->create([
            'eps' => 'SOLSALUD S.A.'
        ]);
        Eps::factory()->create([
            'eps' => 'SURA'
        ]);
        Eps::factory()->create([
            'eps' => 'UNIMEC'
        ]);
        Eps::factory()->create([
            'eps' => 'UNIVERSIDAD DE ANTIOQUIA'
        ]);

        Eps::factory()->create([
            'eps' => 'UNIVERSIDAD DE CÓRDOBA'
        ]);

        Eps::factory()->create([
            'eps' => 'UNIVERSIDAD DEL ATLÁNTICO'
        ]);

        Eps::factory()->create([
            'eps' => 'UNIVERSIDAD DEL CAUCA'
        ]);

        Eps::factory()->create([
            'eps' => 'UNIVERSIDAD DEL VALLE'
        ]);

        Eps::factory()->create([
            'eps' => 'UNIVERSIDAD INDUSTRIAL DE SANTANDER'
        ]);

        Eps::factory()->create([
            'eps' => 'UNIVERSIDAD NACIONAL DE COLOMBIA'
        ]);

        Eps::factory()->create([
            'eps' => 'UNIVERSIDAD PEDAGÓGICA Y TECNOLÓGICA DE COLOMBIA - UPTC'
        ]);

        Eps::factory()->create([
            'eps' => 'Otro'
        ]);
    }
}
