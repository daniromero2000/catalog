<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Cities\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MyCitiesTableSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        City::factory()->create([
            'dane' => '001',    'city' => 'MEDELLIN',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '002',    'city' => 'ABEJORRAL',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '004',    'city' => 'ABRIAQUI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '021',    'city' => 'ALEJANDRIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '030',    'city' => 'AMAGA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '031',    'city' => 'AMALFI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '034',    'city' => 'ANDES',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '036',    'city' => 'ANGELOPOLIS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '038',    'city' => 'ANGOSTURA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '040',    'city' => 'ANORI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '042',    'city' => 'SANTAFE DE ANTIOQUIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '044',    'city' => 'ANZA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '045',    'city' => 'APARTADO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '051',    'city' => 'ARBOLETES',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '055',    'city' => 'ARGELIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '059',    'city' => 'ARMENIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '079',    'city' => 'BARBOSA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '086',    'city' => 'BELMIRA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '088',    'city' => 'BELLO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '091',    'city' => 'BETANIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '093',    'city' => 'BETULIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '101',    'city' => 'CIUDAD BOLIVAR',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '107',    'city' => 'BRICEÑO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '113',    'city' => 'BURITICA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '120',    'city' => 'CACERES',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '125',    'city' => 'CAICEDO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '129',    'city' => 'CALDAS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '134',    'city' => 'CAMPAMENTO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '138',    'city' => 'CAÑASGORDAS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '142',    'city' => 'CARACOLI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '145',    'city' => 'CARAMANTA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '147',    'city' => 'CAREPA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '148',    'city' => 'EL CARMEN DE VIBORAL',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '150',    'city' => 'CAROLINA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '154',    'city' => 'CAUCASIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '172',    'city' => 'CHIGORODO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '190',    'city' => 'CISNEROS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '197',    'city' => 'COCORNA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '206',    'city' => 'CONCEPCION',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '209',    'city' => 'CONCORDIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '212',    'city' => 'COPACABANA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '234',    'city' => 'DABEIBA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '237',    'city' => 'DON MATIAS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '240',    'city' => 'EBEJICO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '250',    'city' => 'EL BAGRE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '264',    'city' => 'ENTRERRIOS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '266',    'city' => 'ENVIGADO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '282',    'city' => 'FREDONIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '284',    'city' => 'FRONTINO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '306',    'city' => 'GIRALDO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '308',    'city' => 'GIRARDOTA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '310',    'city' => 'GOMEZ PLATA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '313',    'city' => 'GRANADA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '315',    'city' => 'GUADALUPE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '318',    'city' => 'GUARNE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '321',    'city' => 'GUATAPE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '347',    'city' => 'HELICONIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '353',    'city' => 'HISPANIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '360',    'city' => 'ITAGUI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '361',    'city' => 'ITUANGO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '364',    'city' => 'JARDIN',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '368',    'city' => 'JERICO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '376',    'city' => 'LA CEJA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '380',    'city' => 'LA ESTRELLA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '390',    'city' => 'LA PINTADA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '400',    'city' => 'LA UNION',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '411',    'city' => 'LIBORINA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '425',    'city' => 'MACEO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '440',    'city' => 'MARINILLA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '467',    'city' => 'MONTEBELLO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '475',    'city' => 'MURINDO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '480',    'city' => 'MUTATA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '483',    'city' => 'NARIÑO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '490',    'city' => 'NECOCLI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '495',    'city' => 'NECHI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '501',    'city' => 'OLAYA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '541',    'city' => 'PEÐOL',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '543',    'city' => 'PEQUE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '576',    'city' => 'PUEBLORRICO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '579',    'city' => 'PUERTO BERRIO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '585',    'city' => 'PUERTO NARE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '591',    'city' => 'PUERTO TRIUNFO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '604',    'city' => 'REMEDIOS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '607',    'city' => 'RETIRO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '615',    'city' => 'RIONEGRO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '628',    'city' => 'SABANALARGA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '631',    'city' => 'SABANETA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '642',    'city' => 'SALGAR',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '647',    'city' => 'SAN ANDRES DE CUERQUIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '649',    'city' => 'SAN CARLOS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '652',    'city' => 'SAN FRANCISCO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '656',    'city' => 'SAN JERONIMO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '658',    'city' => 'SAN JOSE DE LA MONTAÑA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '659',    'city' => 'SAN JUAN DE URABA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '660',    'city' => 'SAN LUIS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '664',    'city' => 'SAN PEDRO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '665',    'city' => 'SAN PEDRO DE URABA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '667',    'city' => 'SAN RAFAEL',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '670',    'city' => 'SAN ROQUE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '674',    'city' => 'SAN VICENTE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '679',    'city' => 'SANTA BARBARA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '686',    'city' => 'SANTA ROSA DE OSOS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '690',    'city' => 'SANTO DOMINGO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '697',    'city' => 'EL SANTUARIO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '736',    'city' => 'SEGOVIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '756',    'city' => 'SONSON',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '761',    'city' => 'SOPETRAN',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '789',    'city' => 'TAMESIS',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '790',    'city' => 'TARAZA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '792',    'city' => 'TARSO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '809',    'city' => 'TITIRIBI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '819',    'city' => 'TOLEDO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '837',    'city' => 'TURBO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '842',    'city' => 'URAMITA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '847',    'city' => 'URRAO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '854',    'city' => 'VALDIVIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '856',    'city' => 'VALPARAISO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '858',    'city' => 'VEGACHI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '861',    'city' => 'VENECIA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '873',    'city' => 'VIGIA DEL FUERTE',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '885',    'city' => 'YALI',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '887',    'city' => 'YARUMAL',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '890',    'city' => 'YOLOMBO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '893',    'city' => 'YONDO',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '895',    'city' => 'ZARAGOZA',    'province_id' => '1'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'BARRANQUILLA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '078',    'city' => 'BARANOA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '137',    'city' => 'CAMPO DE LA CRUZ',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '141',    'city' => 'CANDELARIA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '296',    'city' => 'GALAPA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '372',    'city' => 'JUAN DE ACOSTA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '421',    'city' => 'LURUACO',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '433',    'city' => 'MALAMBO',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '436',    'city' => 'MANATI',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '520',    'city' => 'PALMAR DE VARELA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '549',    'city' => 'PIOJO',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '558',    'city' => 'POLONUEVO',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '560',    'city' => 'PONEDERA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '573',    'city' => 'PUERTO COLOMBIA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '606',    'city' => 'REPELON',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '634',    'city' => 'SABANAGRANDE',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '638',    'city' => 'SABANALARGA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '675',    'city' => 'SANTA LUCIA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '685',    'city' => 'SANTO TOMAS',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '758',    'city' => 'SOLEDAD',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '770',    'city' => 'SUAN',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '832',    'city' => 'TUBARA',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '849',    'city' => 'USIACURI',    'province_id' => '2'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'BOGOTA, D.C.',    'province_id' => '3'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'CARTAGENA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '006',    'city' => 'ACHI',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '030',    'city' => 'ALTOS DEL ROSARIO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '042',    'city' => 'ARENAL',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '052',    'city' => 'ARJONA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '062',    'city' => 'ARROYOHONDO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '074',    'city' => 'BARRANCO DE LOBA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '140',    'city' => 'CALAMAR',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '160',    'city' => 'CANTAGALLO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '188',    'city' => 'CICUCO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '212',    'city' => 'CORDOBA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '222',    'city' => 'CLEMENCIA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '244',    'city' => 'EL CARMEN DE BOLIVAR',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '248',    'city' => 'EL GUAMO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '268',    'city' => 'EL PEÑON',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '300',    'city' => 'HATILLO DE LOBA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '430',    'city' => 'MAGANGUE',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '433',    'city' => 'MAHATES',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '440',    'city' => 'MARGARITA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '442',    'city' => 'MARIA LA BAJA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '458',    'city' => 'MONTECRISTO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '468',    'city' => 'MOMPOS',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '473',    'city' => 'MORALES',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '490',    'city' => 'NOROSI',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '549',    'city' => 'PINILLOS',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '580',    'city' => 'REGIDOR',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '600',    'city' => 'RIO VIEJO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '620',    'city' => 'SAN CRISTOBAL',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '647',    'city' => 'SAN ESTANISLAO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '650',    'city' => 'SAN FERNANDO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '654',    'city' => 'SAN JACINTO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '655',    'city' => 'SAN JACINTO DEL CAUCA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '657',    'city' => 'SAN JUAN NEPOMUCENO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '667',    'city' => 'SAN MARTIN DE LOBA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '670',    'city' => 'SAN PABLO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '673',    'city' => 'SANTA CATALINA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '683',    'city' => 'SANTA ROSA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '688',    'city' => 'SANTA ROSA DEL SUR',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '744',    'city' => 'SIMITI',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '760',    'city' => 'SOPLAVIENTO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '780',    'city' => 'TALAIGUA NUEVO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '810',    'city' => 'TIQUISIO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '836',    'city' => 'TURBACO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '838',    'city' => 'TURBANA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '873',    'city' => 'VILLANUEVA',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '894',    'city' => 'ZAMBRANO',    'province_id' => '4'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'TUNJA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '022',    'city' => 'ALMEIDA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '047',    'city' => 'AQUITANIA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '051',    'city' => 'ARCABUCO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '087',    'city' => 'BELEN',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '090',    'city' => 'BERBEO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '092',    'city' => 'BETEITIVA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '097',    'city' => 'BOAVITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '104',    'city' => 'BOYACA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '106',    'city' => 'BRICEÑO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '109',    'city' => 'BUENAVISTA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '114',    'city' => 'BUSBANZA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '131',    'city' => 'CALDAS',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '135',    'city' => 'CAMPOHERMOSO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '162',    'city' => 'CERINZA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '172',    'city' => 'CHINAVITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '176',    'city' => 'CHIQUINQUIRA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '180',    'city' => 'CHISCAS',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '183',    'city' => 'CHITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '185',    'city' => 'CHITARAQUE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '187',    'city' => 'CHIVATA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '189',    'city' => 'CIENEGA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '204',    'city' => 'COMBITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '212',    'city' => 'COPER',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '215',    'city' => 'CORRALES',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '218',    'city' => 'COVARACHIA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '223',    'city' => 'CUBARA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '224',    'city' => 'CUCAITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '226',    'city' => 'CUITIVA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '232',    'city' => 'CHIQUIZA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '236',    'city' => 'CHIVOR',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '238',    'city' => 'DUITAMA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '244',    'city' => 'EL COCUY',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '248',    'city' => 'EL ESPINO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '272',    'city' => 'FIRAVITOBA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '276',    'city' => 'FLORESTA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '293',    'city' => 'GACHANTIVA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '296',    'city' => 'GAMEZA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '299',    'city' => 'GARAGOA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '317',    'city' => 'GUACAMAYAS',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '322',    'city' => 'GUATEQUE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '325',    'city' => 'GUAYATA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '332',    'city' => 'GsICAN',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '362',    'city' => 'IZA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '367',    'city' => 'JENESANO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '368',    'city' => 'JERICO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '377',    'city' => 'LABRANZAGRANDE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '380',    'city' => 'LA CAPILLA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '401',    'city' => 'LA VICTORIA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '403',    'city' => 'LA UVITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '407',    'city' => 'VILLA DE LEYVA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '425',    'city' => 'MACANAL',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '442',    'city' => 'MARIPI',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '455',    'city' => 'MIRAFLORES',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '464',    'city' => 'MONGUA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '466',    'city' => 'MONGUI',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '469',    'city' => 'MONIQUIRA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '476',    'city' => 'MOTAVITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '480',    'city' => 'MUZO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '491',    'city' => 'NOBSA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '494',    'city' => 'NUEVO COLON',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '500',    'city' => 'OICATA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '507',    'city' => 'OTANCHE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '511',    'city' => 'PACHAVITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '514',    'city' => 'PAEZ',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '516',    'city' => 'PAIPA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '518',    'city' => 'PAJARITO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '522',    'city' => 'PANQUEBA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '531',    'city' => 'PAUNA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '533',    'city' => 'PAYA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '537',    'city' => 'PAZ DE RIO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '542',    'city' => 'PESCA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '550',    'city' => 'PISBA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '572',    'city' => 'PUERTO BOYACA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '580',    'city' => 'QUIPAMA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '599',    'city' => 'RAMIRIQUI',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '600',    'city' => 'RAQUIRA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '621',    'city' => 'RONDON',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '632',    'city' => 'SABOYA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '638',    'city' => 'SACHICA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '646',    'city' => 'SAMACA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '660',    'city' => 'SAN EDUARDO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '664',    'city' => 'SAN JOSE DE PARE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '667',    'city' => 'SAN LUIS DE GACENO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '673',    'city' => 'SAN MATEO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '676',    'city' => 'SAN MIGUEL DE SEMA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '681',    'city' => 'SAN PABLO DE BORBUR',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '686',    'city' => 'SANTANA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '690',    'city' => 'SANTA MARIA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '693',    'city' => 'SANTA ROSA DE VITERBO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '696',    'city' => 'SANTA SOFIA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '720',    'city' => 'SATIVANORTE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '723',    'city' => 'SATIVASUR',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '740',    'city' => 'SIACHOQUE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '753',    'city' => 'SOATA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '755',    'city' => 'SOCOTA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '757',    'city' => 'SOCHA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '759',    'city' => 'SOGAMOSO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '761',    'city' => 'SOMONDOCO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '762',    'city' => 'SORA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '763',    'city' => 'SOTAQUIRA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '764',    'city' => 'SORACA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '774',    'city' => 'SUSACON',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '776',    'city' => 'SUTAMARCHAN',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '778',    'city' => 'SUTATENZA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '790',    'city' => 'TASCO',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '798',    'city' => 'TENZA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '804',    'city' => 'TIBANA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '806',    'city' => 'TIBASOSA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '808',    'city' => 'TINJACA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '810',    'city' => 'TIPACOQUE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '814',    'city' => 'TOCA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '816',    'city' => 'TOGsI',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '820',    'city' => 'TOPAGA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '822',    'city' => 'TOTA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '832',    'city' => 'TUNUNGUA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '835',    'city' => 'TURMEQUE',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '837',    'city' => 'TUTA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '839',    'city' => 'TUTAZA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '842',    'city' => 'UMBITA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '861',    'city' => 'VENTAQUEMADA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '879',    'city' => 'VIRACACHA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '897',    'city' => 'ZETAQUIRA',    'province_id' => '5'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'MANIZALES',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '013',    'city' => 'AGUADAS',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '042',    'city' => 'ANSERMA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '050',    'city' => 'ARANZAZU',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '088',    'city' => 'BELALCAZAR',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '174',    'city' => 'CHINCHINA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '272',    'city' => 'FILADELFIA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '380',    'city' => 'LA DORADA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '388',    'city' => 'LA MERCED',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '433',    'city' => 'MANZANARES',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '442',    'city' => 'MARMATO',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '444',    'city' => 'MARQUETALIA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '446',    'city' => 'MARULANDA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '486',    'city' => 'NEIRA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '495',    'city' => 'NORCASIA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '513',    'city' => 'PACORA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '524',    'city' => 'PALESTINA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '541',    'city' => 'PENSILVANIA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '614',    'city' => 'RIOSUCIO',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '616',    'city' => 'RISARALDA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '653',    'city' => 'SALAMINA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '662',    'city' => 'SAMANA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '665',    'city' => 'SAN JOSE',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '777',    'city' => 'SUPIA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '867',    'city' => 'VICTORIA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '873',    'city' => 'VILLAMARIA',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '877',    'city' => 'VITERBO',    'province_id' => '6'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'FLORENCIA',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '029',    'city' => 'ALBANIA',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '094',    'city' => 'BELEN DE LOS ANDAQUIES',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '150',    'city' => 'CARTAGENA DEL CHAIRA',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '205',    'city' => 'CURILLO',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '247',    'city' => 'EL DONCELLO',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '256',    'city' => 'EL PAUJIL',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '410',    'city' => 'LA MONTAÑITA',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '460',    'city' => 'MILAN',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '479',    'city' => 'MORELIA',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '592',    'city' => 'PUERTO RICO',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '610',    'city' => 'SAN JOSE DEL FRAGUA',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '753',    'city' => 'SAN VICENTE DEL CAGUAN',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '756',    'city' => 'SOLANO',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '785',    'city' => 'SOLITA',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '860',    'city' => 'VALPARAISO',    'province_id' => '7'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'POPAYAN',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '022',    'city' => 'ALMAGUER',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '050',    'city' => 'ARGELIA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '075',    'city' => 'BALBOA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '100',    'city' => 'BOLIVAR',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '110',    'city' => 'BUENOS AIRES',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '130',    'city' => 'CAJIBIO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '137',    'city' => 'CALDONO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '142',    'city' => 'CALOTO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '212',    'city' => 'CORINTO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '256',    'city' => 'EL TAMBO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '290',    'city' => 'FLORENCIA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '300',    'city' => 'GUACHENE',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '318',    'city' => 'GUAPI',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '355',    'city' => 'INZA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '364',    'city' => 'JAMBALO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '392',    'city' => 'LA SIERRA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '397',    'city' => 'LA VEGA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '418',    'city' => 'LOPEZ',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '450',    'city' => 'MERCADERES',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '455',    'city' => 'MIRANDA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '473',    'city' => 'MORALES',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '513',    'city' => 'PADILLA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '517',    'city' => 'PAEZ',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '532',    'city' => 'PATIA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '533',    'city' => 'PIAMONTE',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '548',    'city' => 'PIENDAMO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '573',    'city' => 'PUERTO TEJADA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '585',    'city' => 'PURACE',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '622',    'city' => 'ROSAS',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '693',    'city' => 'SAN SEBASTIAN',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '698',    'city' => 'SANTANDER DE QUILICHAO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '701',    'city' => 'SANTA ROSA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '743',    'city' => 'SILVIA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '760',    'city' => 'SOTARA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '780',    'city' => 'SUAREZ',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '785',    'city' => 'SUCRE',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '807',    'city' => 'TIMBIO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '809',    'city' => 'TIMBIQUI',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '821',    'city' => 'TORIBIO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '824',    'city' => 'TOTORO',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '845',    'city' => 'VILLA RICA',    'province_id' => '8'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'VALLEDUPAR',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '011',    'city' => 'AGUACHICA',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '013',    'city' => 'AGUSTIN CODAZZI',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '032',    'city' => 'ASTREA',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '045',    'city' => 'BECERRIL',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '060',    'city' => 'BOSCONIA',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '175',    'city' => 'CHIMICHAGUA',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '178',    'city' => 'CHIRIGUANA',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '228',    'city' => 'CURUMANI',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '238',    'city' => 'EL COPEY',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '250',    'city' => 'EL PASO',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '295',    'city' => 'GAMARRA',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '310',    'city' => 'GONZALEZ',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '383',    'city' => 'LA GLORIA',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '400',    'city' => 'LA JAGUA DE IBIRICO',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '443',    'city' => 'MANAURE',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '517',    'city' => 'PAILITAS',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '550',    'city' => 'PELAYA',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '570',    'city' => 'PUEBLO BELLO',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '614',    'city' => 'RIO DE ORO',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '621',    'city' => 'LA PAZ',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '710',    'city' => 'SAN ALBERTO',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '750',    'city' => 'SAN DIEGO',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '770',    'city' => 'SAN MARTIN',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '787',    'city' => 'TAMALAMEQUE',    'province_id' => '9'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'MONTERIA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '068',    'city' => 'AYAPEL',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '079',    'city' => 'BUENAVISTA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '090',    'city' => 'CANALETE',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '162',    'city' => 'CERETE',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '168',    'city' => 'CHIMA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '182',    'city' => 'CHINU',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '189',    'city' => 'CIENAGA DE ORO',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '300',    'city' => 'COTORRA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '350',    'city' => 'LA APARTADA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '417',    'city' => 'LORICA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '419',    'city' => 'LOS CORDOBAS',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '464',    'city' => 'MOMIL',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '466',    'city' => 'MONTELIBANO',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '500',    'city' => 'MOÑITOS',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '555',    'city' => 'PLANETA RICA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '570',    'city' => 'PUEBLO NUEVO',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '574',    'city' => 'PUERTO ESCONDIDO',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '580',    'city' => 'PUERTO LIBERTADOR',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '586',    'city' => 'PURISIMA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '660',    'city' => 'SAHAGUN',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '670',    'city' => 'SAN ANDRES SOTAVENTO',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '672',    'city' => 'SAN ANTERO',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '675',    'city' => 'SAN BERNARDO DEL VIENTO',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '678',    'city' => 'SAN CARLOS',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '686',    'city' => 'SAN PELAYO',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '807',    'city' => 'TIERRALTA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '855',    'city' => 'VALENCIA',    'province_id' => '10'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'AGUA DE DIOS',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '019',    'city' => 'ALBAN',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '035',    'city' => 'ANAPOIMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '040',    'city' => 'ANOLAIMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '053',    'city' => 'ARBELAEZ',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '086',    'city' => 'BELTRAN',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '095',    'city' => 'BITUIMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '099',    'city' => 'BOJACA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '120',    'city' => 'CABRERA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '123',    'city' => 'CACHIPAY',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '126',    'city' => 'CAJICA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '148',    'city' => 'CAPARRAPI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '151',    'city' => 'CAQUEZA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '154',    'city' => 'CARMEN DE CARUPA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '168',    'city' => 'CHAGUANI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '175',    'city' => 'CHIA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '178',    'city' => 'CHIPAQUE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '181',    'city' => 'CHOACHI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '183',    'city' => 'CHOCONTA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '200',    'city' => 'COGUA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '214',    'city' => 'COTA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '224',    'city' => 'CUCUNUBA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '245',    'city' => 'EL COLEGIO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '258',    'city' => 'EL PEÑON',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '260',    'city' => 'EL ROSAL',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '269',    'city' => 'FACATATIVA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '279',    'city' => 'FOMEQUE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '281',    'city' => 'FOSCA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '286',    'city' => 'FUNZA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '288',    'city' => 'FUQUENE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '290',    'city' => 'FUSAGASUGA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '293',    'city' => 'GACHALA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '295',    'city' => 'GACHANCIPA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '297',    'city' => 'GACHETA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '299',    'city' => 'GAMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '307',    'city' => 'GIRARDOT',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '312',    'city' => 'GRANADA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '317',    'city' => 'GUACHETA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '320',    'city' => 'GUADUAS',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '322',    'city' => 'GUASCA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '324',    'city' => 'GUATAQUI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '326',    'city' => 'GUATAVITA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '328',    'city' => 'GUAYABAL DE SIQUIMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '335',    'city' => 'GUAYABETAL',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '339',    'city' => 'GUTIERREZ',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '368',    'city' => 'JERUSALEN',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '372',    'city' => 'JUNIN',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '377',    'city' => 'LA CALERA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '386',    'city' => 'LA MESA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '394',    'city' => 'LA PALMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '398',    'city' => 'LA PEÑA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '402',    'city' => 'LA VEGA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '407',    'city' => 'LENGUAZAQUE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '426',    'city' => 'MACHETA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '430',    'city' => 'MADRID',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '436',    'city' => 'MANTA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '438',    'city' => 'MEDINA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '473',    'city' => 'MOSQUERA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '483',    'city' => 'NARIÑO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '486',    'city' => 'NEMOCON',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '488',    'city' => 'NILO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '489',    'city' => 'NIMAIMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '491',    'city' => 'NOCAIMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '506',    'city' => 'VENECIA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '513',    'city' => 'PACHO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '518',    'city' => 'PAIME',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '524',    'city' => 'PANDI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '530',    'city' => 'PARATEBUENO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '535',    'city' => 'PASCA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '572',    'city' => 'PUERTO SALGAR',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '580',    'city' => 'PULI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '592',    'city' => 'QUEBRADANEGRA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '594',    'city' => 'QUETAME',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '596',    'city' => 'QUIPILE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '599',    'city' => 'APULO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '612',    'city' => 'RICAURTE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '645',    'city' => 'SAN ANTONIO DEL TEQUENDAMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '649',    'city' => 'SAN BERNARDO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '653',    'city' => 'SAN CAYETANO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '658',    'city' => 'SAN FRANCISCO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '662',    'city' => 'SAN JUAN DE RIO SECO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '718',    'city' => 'SASAIMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '736',    'city' => 'SESQUILE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '740',    'city' => 'SIBATE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '743',    'city' => 'SILVANIA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '745',    'city' => 'SIMIJACA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '754',    'city' => 'SOACHA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '758',    'city' => 'SOPO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '769',    'city' => 'SUBACHOQUE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '772',    'city' => 'SUESCA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '777',    'city' => 'SUPATA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '779',    'city' => 'SUSA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '781',    'city' => 'SUTATAUSA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '785',    'city' => 'TABIO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '793',    'city' => 'TAUSA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '797',    'city' => 'TENA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '799',    'city' => 'TENJO',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '805',    'city' => 'TIBACUY',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '807',    'city' => 'TIBIRITA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '815',    'city' => 'TOCAIMA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '817',    'city' => 'TOCANCIPA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '823',    'city' => 'TOPAIPI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '839',    'city' => 'UBALA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '841',    'city' => 'UBAQUE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '843',    'city' => 'VILLA DE SAN DIEGO DE UBATE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '845',    'city' => 'UNE',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '851',    'city' => 'UTICA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '862',    'city' => 'VERGARA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '867',    'city' => 'VIANI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '871',    'city' => 'VILLAGOMEZ',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '873',    'city' => 'VILLAPINZON',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '875',    'city' => 'VILLETA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '878',    'city' => 'VIOTA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '885',    'city' => 'YACOPI',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '898',    'city' => 'ZIPACON',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '899',    'city' => 'ZIPAQUIRA',    'province_id' => '11'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'QUIBDO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '006',    'city' => 'ACANDI',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '025',    'city' => 'ALTO BAUDO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '050',    'city' => 'ATRATO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '073',    'city' => 'BAGADO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '075',    'city' => 'BAHIA SOLANO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '077',    'city' => 'BAJO BAUDO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '099',    'city' => 'BOJAYA',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '135',    'city' => 'EL CANTON DEL SAN PABLO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '150',    'city' => 'CARMEN DEL DARIEN',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '160',    'city' => 'CERTEGUI',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '205',    'city' => 'CONDOTO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '245',    'city' => 'EL CARMEN DE ATRATO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '250',    'city' => 'EL LITORAL DEL SAN JUAN',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '361',    'city' => 'ISTMINA',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '372',    'city' => 'JURADO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '413',    'city' => 'LLORO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '425',    'city' => 'MEDIO ATRATO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '430',    'city' => 'MEDIO BAUDO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '450',    'city' => 'MEDIO SAN JUAN',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '491',    'city' => 'NOVITA',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '495',    'city' => 'NUQUI',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '580',    'city' => 'RIO IRO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '600',    'city' => 'RIO QUITO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '615',    'city' => 'RIOSUCIO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '660',    'city' => 'SAN JOSE DEL PALMAR',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '745',    'city' => 'SIPI',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '787',    'city' => 'TADO',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '800',    'city' => 'UNGUIA',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '810',    'city' => 'UNION PANAMERICANA',    'province_id' => '12'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'NEIVA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '006',    'city' => 'ACEVEDO',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '013',    'city' => 'AGRADO',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '016',    'city' => 'AIPE',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '020',    'city' => 'ALGECIRAS',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '026',    'city' => 'ALTAMIRA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '078',    'city' => 'BARAYA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '132',    'city' => 'CAMPOALEGRE',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '206',    'city' => 'COLOMBIA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '244',    'city' => 'ELIAS',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '298',    'city' => 'GARZON',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '306',    'city' => 'GIGANTE',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '319',    'city' => 'GUADALUPE',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '349',    'city' => 'HOBO',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '357',    'city' => 'IQUIRA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '359',    'city' => 'ISNOS',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '378',    'city' => 'LA ARGENTINA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '396',    'city' => 'LA PLATA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '483',    'city' => 'NATAGA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '503',    'city' => 'OPORAPA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '518',    'city' => 'PAICOL',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '524',    'city' => 'PALERMO',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '530',    'city' => 'PALESTINA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '548',    'city' => 'PITAL',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '551',    'city' => 'PITALITO',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '615',    'city' => 'RIVERA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '660',    'city' => 'SALADOBLANCO',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '668',    'city' => 'SAN AGUSTIN',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '676',    'city' => 'SANTA MARIA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '770',    'city' => 'SUAZA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '791',    'city' => 'TARQUI',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '797',    'city' => 'TESALIA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '799',    'city' => 'TELLO',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '801',    'city' => 'TERUEL',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '807',    'city' => 'TIMANA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '872',    'city' => 'VILLAVIEJA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '885',    'city' => 'YAGUARA',    'province_id' => '13'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'RIOHACHA',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '035',    'city' => 'ALBANIA',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '078',    'city' => 'BARRANCAS',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '090',    'city' => 'DIBULLA',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '098',    'city' => 'DISTRACCION',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '110',    'city' => 'EL MOLINO',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '279',    'city' => 'FONSECA',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '378',    'city' => 'HATONUEVO',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '420',    'city' => 'LA JAGUA DEL PILAR',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '430',    'city' => 'MAICAO',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '560',    'city' => 'MANAURE',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '650',    'city' => 'SAN JUAN DEL CESAR',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '847',    'city' => 'URIBIA',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '855',    'city' => 'URUMITA',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '874',    'city' => 'VILLANUEVA',    'province_id' => '14'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'SANTA MARTA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '030',    'city' => 'ALGARROBO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '053',    'city' => 'ARACATACA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '058',    'city' => 'ARIGUANI',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '161',    'city' => 'CERRO SAN ANTONIO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '170',    'city' => 'CHIBOLO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '189',    'city' => 'CIENAGA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '205',    'city' => 'CONCORDIA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '245',    'city' => 'EL BANCO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '258',    'city' => 'EL PIÑON',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '268',    'city' => 'EL RETEN',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '288',    'city' => 'FUNDACION',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '318',    'city' => 'GUAMAL',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '460',    'city' => 'NUEVA GRANADA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '541',    'city' => 'PEDRAZA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '545',    'city' => 'PIJIÑO DEL CARMEN',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '551',    'city' => 'PIVIJAY',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '555',    'city' => 'PLATO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '570',    'city' => 'PUEBLOVIEJO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '605',    'city' => 'REMOLINO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '660',    'city' => 'SABANAS DE SAN ANGEL',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '675',    'city' => 'SALAMINA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '692',    'city' => 'SAN SEBASTIAN DE BUENAVISTA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '703',    'city' => 'SAN ZENON',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '707',    'city' => 'SANTA ANA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '720',    'city' => 'SANTA BARBARA DE PINTO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '745',    'city' => 'SITIONUEVO',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '798',    'city' => 'TENERIFE',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '960',    'city' => 'ZAPAYAN',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '980',    'city' => 'ZONA BANANERA',    'province_id' => '15'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'VILLAVICENCIO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '006',    'city' => 'ACACIAS',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '110',    'city' => 'BARRANCA DE UPIA',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '124',    'city' => 'CABUYARO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '150',    'city' => 'CASTILLA LA NUEVA',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '223',    'city' => 'CUBARRAL',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '226',    'city' => 'CUMARAL',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '245',    'city' => 'EL CALVARIO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '251',    'city' => 'EL CASTILLO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '270',    'city' => 'EL DORADO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '287',    'city' => 'FUENTE DE ORO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '313',    'city' => 'GRANADA',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '318',    'city' => 'GUAMAL',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '325',    'city' => 'MAPIRIPAN',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '330',    'city' => 'MESETAS',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '350',    'city' => 'LA MACARENA',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '370',    'city' => 'URIBE',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '400',    'city' => 'LEJANIAS',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '450',    'city' => 'PUERTO CONCORDIA',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '568',    'city' => 'PUERTO GAITAN',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '573',    'city' => 'PUERTO LOPEZ',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '577',    'city' => 'PUERTO LLERAS',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '590',    'city' => 'PUERTO RICO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '606',    'city' => 'RESTREPO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '680',    'city' => 'SAN CARLOS DE GUAROA',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '683',    'city' => 'SAN JUAN DE ARAMA',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '686',    'city' => 'SAN JUANITO',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '689',    'city' => 'SAN MARTIN',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '711',    'city' => 'VISTAHERMOSA',    'province_id' => '16'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'PASTO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '019',    'city' => 'ALBAN',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '022',    'city' => 'ALDANA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '036',    'city' => 'ANCUYA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '051',    'city' => 'ARBOLEDA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '079',    'city' => 'BARBACOAS',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '083',    'city' => 'BELEN',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '110',    'city' => 'BUESACO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '203',    'city' => 'COLON',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '207',    'city' => 'CONSACA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '210',    'city' => 'CONTADERO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '215',    'city' => 'CORDOBA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '224',    'city' => 'CUASPUD',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '227',    'city' => 'CUMBAL',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '233',    'city' => 'CUMBITARA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '240',    'city' => 'CHACHAGsI',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '250',    'city' => 'EL CHARCO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '254',    'city' => 'EL PEÑOL',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '256',    'city' => 'EL ROSARIO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '258',    'city' => 'EL TABLON DE GOMEZ',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '260',    'city' => 'EL TAMBO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '287',    'city' => 'FUNES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '317',    'city' => 'GUACHUCAL',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '320',    'city' => 'GUAITARILLA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '323',    'city' => 'GUALMATAN',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '352',    'city' => 'ILES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '354',    'city' => 'IMUES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '356',    'city' => 'IPIALES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '378',    'city' => 'LA CRUZ',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '381',    'city' => 'LA FLORIDA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '385',    'city' => 'LA LLANADA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '390',    'city' => 'LA TOLA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '399',    'city' => 'LA UNION',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '405',    'city' => 'LEIVA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '411',    'city' => 'LINARES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '418',    'city' => 'LOS ANDES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '427',    'city' => 'MAGsI',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '435',    'city' => 'MALLAMA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '473',    'city' => 'MOSQUERA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '480',    'city' => 'NARIÑO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '490',    'city' => 'OLAYA HERRERA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '506',    'city' => 'OSPINA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '520',    'city' => 'FRANCISCO PIZARRO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '540',    'city' => 'POLICARPA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '560',    'city' => 'POTOSI',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '565',    'city' => 'PROVIDENCIA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '573',    'city' => 'PUERRES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '585',    'city' => 'PUPIALES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '612',    'city' => 'RICAURTE',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '621',    'city' => 'ROBERTO PAYAN',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '678',    'city' => 'SAMANIEGO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '683',    'city' => 'SANDONA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '685',    'city' => 'SAN BERNARDO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '687',    'city' => 'SAN LORENZO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '693',    'city' => 'SAN PABLO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '694',    'city' => 'SAN PEDRO DE CARTAGO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '696',    'city' => 'SANTA BARBARA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '699',    'city' => 'SANTACRUZ',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '720',    'city' => 'SAPUYES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '786',    'city' => 'TAMINANGO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '788',    'city' => 'TANGUA',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '835',    'city' => 'SAN ANDRES DE TUMACO',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '838',    'city' => 'TUQUERRES',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '885',    'city' => 'YACUANQUER',    'province_id' => '17'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'CUCUTA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '003',    'city' => 'ABREGO',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '051',    'city' => 'ARBOLEDAS',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '099',    'city' => 'BOCHALEMA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '109',    'city' => 'BUCARASICA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '125',    'city' => 'CACOTA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '128',    'city' => 'CACHIRA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '172',    'city' => 'CHINACOTA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '174',    'city' => 'CHITAGA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '206',    'city' => 'CONVENCION',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '223',    'city' => 'CUCUTILLA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '239',    'city' => 'DURANIA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '245',    'city' => 'EL CARMEN',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '250',    'city' => 'EL TARRA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '261',    'city' => 'EL ZULIA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '313',    'city' => 'GRAMALOTE',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '344',    'city' => 'HACARI',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '347',    'city' => 'HERRAN',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '377',    'city' => 'LABATECA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '385',    'city' => 'LA ESPERANZA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '398',    'city' => 'LA PLAYA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '405',    'city' => 'LOS PATIOS',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '418',    'city' => 'LOURDES',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '480',    'city' => 'MUTISCUA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '498',    'city' => 'OCAÑA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '518',    'city' => 'PAMPLONA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '520',    'city' => 'PAMPLONITA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '553',    'city' => 'PUERTO SANTANDER',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '599',    'city' => 'RAGONVALIA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '660',    'city' => 'SALAZAR',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '670',    'city' => 'SAN CALIXTO',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '673',    'city' => 'SAN CAYETANO',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '680',    'city' => 'SANTIAGO',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '720',    'city' => 'SARDINATA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '743',    'city' => 'SILOS',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '800',    'city' => 'TEORAMA',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '810',    'city' => 'TIBU',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '820',    'city' => 'TOLEDO',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '871',    'city' => 'VILLA CARO',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '874',    'city' => 'VILLA DEL ROSARIO',    'province_id' => '18'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'ARMENIA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '111',    'city' => 'BUENAVISTA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '130',    'city' => 'CALARCA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '190',    'city' => 'CIRCASIA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '212',    'city' => 'CORDOBA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '272',    'city' => 'FILANDIA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '302',    'city' => 'GENOVA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '401',    'city' => 'LA TEBAIDA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '470',    'city' => 'MONTENEGRO',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '548',    'city' => 'PIJAO',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '594',    'city' => 'QUIMBAYA',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '690',    'city' => 'SALENTO',    'province_id' => '19'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'PEREIRA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '045',    'city' => 'APIA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '075',    'city' => 'BALBOA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '088',    'city' => 'BELEN DE UMBRIA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '170',    'city' => 'DOSQUEBRADAS',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '318',    'city' => 'GUATICA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '383',    'city' => 'LA CELIA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '400',    'city' => 'LA VIRGINIA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '440',    'city' => 'MARSELLA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '456',    'city' => 'MISTRATO',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '572',    'city' => 'PUEBLO RICO',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '594',    'city' => 'QUINCHIA',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '682',    'city' => 'SANTA ROSA DE CABAL',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '687',    'city' => 'SANTUARIO',    'province_id' => '20'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'BUCARAMANGA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '013',    'city' => 'AGUADA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '020',    'city' => 'ALBANIA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '051',    'city' => 'ARATOCA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '077',    'city' => 'BARBOSA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '079',    'city' => 'BARICHARA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '081',    'city' => 'BARRANCABERMEJA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '092',    'city' => 'BETULIA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '101',    'city' => 'BOLIVAR',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '121',    'city' => 'CABRERA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '132',    'city' => 'CALIFORNIA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '147',    'city' => 'CAPITANEJO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '152',    'city' => 'CARCASI',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '160',    'city' => 'CEPITA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '162',    'city' => 'CERRITO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '167',    'city' => 'CHARALA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '169',    'city' => 'CHARTA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '176',    'city' => 'CHIMA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '179',    'city' => 'CHIPATA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '190',    'city' => 'CIMITARRA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '207',    'city' => 'CONCEPCION',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '209',    'city' => 'CONFINES',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '211',    'city' => 'CONTRATACION',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '217',    'city' => 'COROMORO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '229',    'city' => 'CURITI',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '235',    'city' => 'EL CARMEN DE CHUCURI',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '245',    'city' => 'EL GUACAMAYO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '250',    'city' => 'EL PEÑON',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '255',    'city' => 'EL PLAYON',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '264',    'city' => 'ENCINO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '266',    'city' => 'ENCISO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '271',    'city' => 'FLORIAN',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '276',    'city' => 'FLORIDABLANCA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '296',    'city' => 'GALAN',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '298',    'city' => 'GAMBITA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '307',    'city' => 'GIRON',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '318',    'city' => 'GUACA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '320',    'city' => 'GUADALUPE',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '322',    'city' => 'GUAPOTA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '324',    'city' => 'GUAVATA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '327',    'city' => 'GsEPSA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '344',    'city' => 'HATO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '368',    'city' => 'JESUS MARIA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '370',    'city' => 'JORDAN',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '377',    'city' => 'LA BELLEZA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '385',    'city' => 'LANDAZURI',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '397',    'city' => 'LA PAZ',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '406',    'city' => 'LEBRIJA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '418',    'city' => 'LOS SANTOS',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '425',    'city' => 'MACARAVITA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '432',    'city' => 'MALAGA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '444',    'city' => 'MATANZA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '464',    'city' => 'MOGOTES',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '468',    'city' => 'MOLAGAVITA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '498',    'city' => 'OCAMONTE',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '500',    'city' => 'OIBA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '502',    'city' => 'ONZAGA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '522',    'city' => 'PALMAR',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '524',    'city' => 'PALMAS DEL SOCORRO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '533',    'city' => 'PARAMO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '547',    'city' => 'PIEDECUESTA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '549',    'city' => 'PINCHOTE',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '572',    'city' => 'PUENTE NACIONAL',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '573',    'city' => 'PUERTO PARRA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '575',    'city' => 'PUERTO WILCHES',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '615',    'city' => 'RIONEGRO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '655',    'city' => 'SABANA DE TORRES',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '669',    'city' => 'SAN ANDRES',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '673',    'city' => 'SAN BENITO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '679',    'city' => 'SAN GIL',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '682',    'city' => 'SAN JOAQUIN',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '684',    'city' => 'SAN JOSE DE MIRANDA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '686',    'city' => 'SAN MIGUEL',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '689',    'city' => 'SAN VICENTE DE CHUCURI',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '705',    'city' => 'SANTA BARBARA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '720',    'city' => 'SANTA HELENA DEL OPON',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '745',    'city' => 'SIMACOTA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '755',    'city' => 'SOCORRO',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '770',    'city' => 'SUAITA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '773',    'city' => 'SUCRE',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '780',    'city' => 'SURATA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '820',    'city' => 'TONA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '855',    'city' => 'VALLE DE SAN JOSE',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '861',    'city' => 'VELEZ',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '867',    'city' => 'VETAS',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '872',    'city' => 'VILLANUEVA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '895',    'city' => 'ZAPATOCA',    'province_id' => '21'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'SINCELEJO',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '110',    'city' => 'BUENAVISTA',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '124',    'city' => 'CAIMITO',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '204',    'city' => 'COLOSO',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '215',    'city' => 'COROZAL',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '221',    'city' => 'COVEÑAS',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '230',    'city' => 'CHALAN',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '233',    'city' => 'EL ROBLE',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '235',    'city' => 'GALERAS',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '265',    'city' => 'GUARANDA',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '400',    'city' => 'LA UNION',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '418',    'city' => 'LOS PALMITOS',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '429',    'city' => 'MAJAGUAL',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '473',    'city' => 'MORROA',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '508',    'city' => 'OVEJAS',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '523',    'city' => 'PALMITO',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '670',    'city' => 'SAMPUES',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '678',    'city' => 'SAN BENITO ABAD',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '702',    'city' => 'SAN JUAN DE BETULIA',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '708',    'city' => 'SAN MARCOS',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '713',    'city' => 'SAN ONOFRE',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '717',    'city' => 'SAN PEDRO',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '742',    'city' => 'SAN LUIS DE SINCE',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '771',    'city' => 'SUCRE',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '820',    'city' => 'SANTIAGO DE TOLU',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '823',    'city' => 'TOLU VIEJO',    'province_id' => '22'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'IBAGUE',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '024',    'city' => 'ALPUJARRA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '026',    'city' => 'ALVARADO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '030',    'city' => 'AMBALEMA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '043',    'city' => 'ANZOATEGUI',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '055',    'city' => 'ARMERO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '067',    'city' => 'ATACO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '124',    'city' => 'CAJAMARCA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '148',    'city' => 'CARMEN DE APICALA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '152',    'city' => 'CASABIANCA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '168',    'city' => 'CHAPARRAL',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '200',    'city' => 'COELLO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '217',    'city' => 'COYAIMA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '226',    'city' => 'CUNDAY',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '236',    'city' => 'DOLORES',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '268',    'city' => 'ESPINAL',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '270',    'city' => 'FALAN',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '275',    'city' => 'FLANDES',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '283',    'city' => 'FRESNO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '319',    'city' => 'GUAMO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '347',    'city' => 'HERVEO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '349',    'city' => 'HONDA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '352',    'city' => 'ICONONZO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '408',    'city' => 'LERIDA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '411',    'city' => 'LIBANO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '443',    'city' => 'MARIQUITA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '449',    'city' => 'MELGAR',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '461',    'city' => 'MURILLO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '483',    'city' => 'NATAGAIMA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '504',    'city' => 'ORTEGA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '520',    'city' => 'PALOCABILDO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '547',    'city' => 'PIEDRAS',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '555',    'city' => 'PLANADAS',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '563',    'city' => 'PRADO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '585',    'city' => 'PURIFICACION',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '616',    'city' => 'RIOBLANCO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '622',    'city' => 'RONCESVALLES',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '624',    'city' => 'ROVIRA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '671',    'city' => 'SALDAÑA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '675',    'city' => 'SAN ANTONIO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '678',    'city' => 'SAN LUIS',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '686',    'city' => 'SANTA ISABEL',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '770',    'city' => 'SUAREZ',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '854',    'city' => 'VALLE DE SAN JUAN',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '861',    'city' => 'VENADILLO',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '870',    'city' => 'VILLAHERMOSA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '873',    'city' => 'VILLARRICA',    'province_id' => '23'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'CALI',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '020',    'city' => 'ALCALA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '036',    'city' => 'ANDALUCIA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '041',    'city' => 'ANSERMANUEVO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '054',    'city' => 'ARGELIA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '100',    'city' => 'BOLIVAR',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '109',    'city' => 'BUENAVENTURA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '111',    'city' => 'GUADALAJARA DE BUGA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '113',    'city' => 'BUGALAGRANDE',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '122',    'city' => 'CAICEDONIA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '126',    'city' => 'CALIMA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '130',    'city' => 'CANDELARIA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '147',    'city' => 'CARTAGO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '233',    'city' => 'DAGUA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '243',    'city' => 'EL AGUILA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '246',    'city' => 'EL CAIRO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '248',    'city' => 'EL CERRITO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '250',    'city' => 'EL DOVIO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '275',    'city' => 'FLORIDA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '306',    'city' => 'GINEBRA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '318',    'city' => 'GUACARI',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '364',    'city' => 'JAMUNDI',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '377',    'city' => 'LA CUMBRE',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '400',    'city' => 'LA UNION',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '403',    'city' => 'LA VICTORIA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '497',    'city' => 'OBANDO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '520',    'city' => 'PALMIRA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '563',    'city' => 'PRADERA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '606',    'city' => 'RESTREPO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '616',    'city' => 'RIOFRIO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '622',    'city' => 'ROLDANILLO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '670',    'city' => 'SAN PEDRO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '736',    'city' => 'SEVILLA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '823',    'city' => 'TORO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '828',    'city' => 'TRUJILLO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '834',    'city' => 'TULUA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '845',    'city' => 'ULLOA',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '863',    'city' => 'VERSALLES',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '869',    'city' => 'VIJES',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '890',    'city' => 'YOTOCO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '892',    'city' => 'YUMBO',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '895',    'city' => 'ZARZAL',    'province_id' => '24'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'ARAUCA',    'province_id' => '25'
        ]);
        City::factory()->create([
            'dane' => '065',    'city' => 'ARAUQUITA',    'province_id' => '25'
        ]);
        City::factory()->create([
            'dane' => '220',    'city' => 'CRAVO NORTE',    'province_id' => '25'
        ]);
        City::factory()->create([
            'dane' => '300',    'city' => 'FORTUL',    'province_id' => '25'
        ]);
        City::factory()->create([
            'dane' => '591',    'city' => 'PUERTO RONDON',    'province_id' => '25'
        ]);
        City::factory()->create([
            'dane' => '736',    'city' => 'SARAVENA',    'province_id' => '25'
        ]);
        City::factory()->create([
            'dane' => '794',    'city' => 'TAME',    'province_id' => '25'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'YOPAL',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '010',    'city' => 'AGUAZUL',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '015',    'city' => 'CHAMEZA',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '125',    'city' => 'HATO COROZAL',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '136',    'city' => 'LA SALINA',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '139',    'city' => 'MANI',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '162',    'city' => 'MONTERREY',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '225',    'city' => 'NUNCHIA',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '230',    'city' => 'OROCUE',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '250',    'city' => 'PAZ DE ARIPORO',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '263',    'city' => 'PORE',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '279',    'city' => 'RECETOR',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '300',    'city' => 'SABANALARGA',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '315',    'city' => 'SACAMA',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '325',    'city' => 'SAN LUIS DE PALENQUE',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '400',    'city' => 'TAMARA',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '410',    'city' => 'TAURAMENA',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '430',    'city' => 'TRINIDAD',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '440',    'city' => 'VILLANUEVA',    'province_id' => '26'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'MOCOA',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '219',    'city' => 'COLON',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '320',    'city' => 'ORITO',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '568',    'city' => 'PUERTO ASIS',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '569',    'city' => 'PUERTO CAICEDO',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '571',    'city' => 'PUERTO GUZMAN',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '573',    'city' => 'LEGUIZAMO',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '749',    'city' => 'SIBUNDOY',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '755',    'city' => 'SAN FRANCISCO',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '757',    'city' => 'SAN MIGUEL',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '760',    'city' => 'SANTIAGO',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '865',    'city' => 'VALLE DEL GUAMUEZ',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '885',    'city' => 'VILLAGARZON',    'province_id' => '27'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'SAN ANDRES',    'province_id' => '28'
        ]);
        City::factory()->create([
            'dane' => '564',    'city' => 'PROVIDENCIA',    'province_id' => '28'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'LETICIA',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '263',    'city' => 'EL ENCANTO',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '405',    'city' => 'LA CHORRERA',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '407',    'city' => 'LA PEDRERA',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '430',    'city' => 'LA VICTORIA',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '460',    'city' => 'MIRITI - PARANA',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '530',    'city' => 'PUERTO ALEGRIA',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '536',    'city' => 'PUERTO ARICA',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '540',    'city' => 'PUERTO NARIÑO',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '669',    'city' => 'PUERTO SANTANDER',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '798',    'city' => 'TARAPACA',    'province_id' => '29'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'INIRIDA',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '343',    'city' => 'BARRANCO MINAS',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '663',    'city' => 'MAPIRIPANA',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '883',    'city' => 'SAN FELIPE',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '884',    'city' => 'PUERTO COLOMBIA',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '885',    'city' => 'LA GUADALUPE',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '886',    'city' => 'CACAHUAL',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '887',    'city' => 'PANA PANA',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '888',    'city' => 'MORICHAL',    'province_id' => '30'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'SAN JOSE DEL GUAVIARE',    'province_id' => '31'
        ]);
        City::factory()->create([
            'dane' => '015',    'city' => 'CALAMAR',    'province_id' => '31'
        ]);
        City::factory()->create([
            'dane' => '025',    'city' => 'EL RETORNO',    'province_id' => '31'
        ]);
        City::factory()->create([
            'dane' => '200',    'city' => 'MIRAFLORES',    'province_id' => '31'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'MITU',    'province_id' => '32'
        ]);
        City::factory()->create([
            'dane' => '161',    'city' => 'CARURU',    'province_id' => '32'
        ]);
        City::factory()->create([
            'dane' => '511',    'city' => 'PACOA',    'province_id' => '32'
        ]);
        City::factory()->create([
            'dane' => '666',    'city' => 'TARAIRA',    'province_id' => '32'
        ]);
        City::factory()->create([
            'dane' => '777',    'city' => 'PAPUNAUA',    'province_id' => '32'
        ]);
        City::factory()->create([
            'dane' => '889',    'city' => 'YAVARATE',    'province_id' => '32'
        ]);
        City::factory()->create([
            'dane' => '001',    'city' => 'PUERTO CARREÑO',    'province_id' => '33'
        ]);
        City::factory()->create([
            'dane' => '524',    'city' => 'LA PRIMAVERA',    'province_id' => '33'
        ]);
        City::factory()->create([
            'dane' => '624',    'city' => 'SANTA ROSALIA',    'province_id' => '33'
        ]);
        City::factory()->create([
            'dane' => '773',    'city' => 'CUMARIBO',    'province_id' => '33'
        ]);
    }
}
