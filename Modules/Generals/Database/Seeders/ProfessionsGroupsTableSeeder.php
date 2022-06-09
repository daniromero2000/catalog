<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\ProfessionsGroups\ProfessionsGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProfessionsGroupsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        ProfessionsGroup::factory()->create([
            'ciuo' => '0110',    'professions_group' => 'Oficiales de las Fuerzas Militares'
        ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '0210',    'professions_group' => 'Suboficiales de las Fuerzas Militares'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '0310',    'professions_group' => 'Otros miembros de las Fuerzas Militares'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1111',    'professions_group' => 'Directores formuladores de políticas y normas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1112',    'professions_group' => 'Directores del gobierno '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1113',    'professions_group' => 'Jefes de comunidades étnicas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1114',    'professions_group' => 'Dirigentes de organizaciones con un interés específico (partidos políticos, sindicatos y organizaciones sociales)  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1120',    'professions_group' => 'Directores y gerentes generales  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1211',    'professions_group' => 'Directores financieros  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1212',    'professions_group' => 'Directores de recursos humanos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1213',    'professions_group' => 'Directores de políticas y planificación  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1219',    'professions_group' => 'Directores de administración y servicios no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1221',    'professions_group' => 'Directores de ventas y comercialización  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1222',    'professions_group' => 'Directores de publicidad y relaciones públicas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1223',    'professions_group' => 'Directores de investigación y desarrollo  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1311',    'professions_group' => 'Directores de producción agropecuaria y silvicultura  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1312',    'professions_group' => 'Directores de producción de piscicultura y pesca  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1321',    'professions_group' => 'Directores de industrias manufactureras  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1322',    'professions_group' => 'Directores de explotaciones de minería  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1323',    'professions_group' => 'Directores de empresas de construcción  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1324',    'professions_group' => 'Directores de empresas de abastecimiento, distribución y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1330',    'professions_group' => 'Directores de servicios de tecnología de la información y las comunicaciones  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1341',    'professions_group' => 'Directores de servicios de cuidados infantiles  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1342',    'professions_group' => 'Directores de servicios de salud  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1343',    'professions_group' => 'Directores de servicios de atención a personas mayores  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1344',    'professions_group' => 'Directores  de servicios de bienestar social  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1345',    'professions_group' => 'Directores de servicios de educación  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1346',    'professions_group' => 'Gerentes de sucursales de bancos, de servicios financieros y de seguros  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1349',    'professions_group' => 'Directores y gerentes de servicios profesionales no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1411',    'professions_group' => 'Gerentes de hoteles  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1412',    'professions_group' => 'Gerentes de restaurantes  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1420',    'professions_group' => 'Gerentes de comercios al por mayor y al por menor  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1431',    'professions_group' => 'Gerentes de centros deportivos, de esparcimiento y culturales  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '1439',    'professions_group' => 'Otros gerentes de servicios no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2111',    'professions_group' => 'Físicos y astrónomos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2112',    'professions_group' => 'Meteorólogos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2113',    'professions_group' => 'Químicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2114',    'professions_group' => 'Geólogos y geofísicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2120',    'professions_group' => 'Matemáticos, actuarios y estadísticos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2131',    'professions_group' => 'Biólogos, botánicos, zoólogos y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2132',    'professions_group' => 'Agrónomos, silvicultores, zootecnistas y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2133',    'professions_group' => 'Profesionales de la protección medioambiental  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2141',    'professions_group' => 'Ingenieros industriales y de producción  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2142',    'professions_group' => 'Ingenieros civiles  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2143',    'professions_group' => 'Ingenieros medioambientales  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2144',    'professions_group' => 'Ingenieros mecánicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2145',    'professions_group' => 'Ingenieros químicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2146',    'professions_group' => 'Ingenieros de minas, metalúrgicos y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2149',    'professions_group' => 'Ingenieros no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2151',    'professions_group' => 'Ingenieros electricistas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2152',    'professions_group' => 'Ingenieros electrónicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2153',    'professions_group' => 'Ingenieros de telecomunicaciones  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2161',    'professions_group' => 'Arquitectos constructores  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2162',    'professions_group' => 'Arquitectos paisajistas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2163',    'professions_group' => 'Diseñadores de productos y de prendas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2164',    'professions_group' => 'Planificadores urbanos, regionales y de tránsito  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2165',    'professions_group' => 'Cartógrafos y topógrafos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2166',    'professions_group' => 'Diseñadores gráficos y multimedia  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2211',    'professions_group' => 'Médicos generales  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2212',    'professions_group' => 'Médicos especialistas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2221',    'professions_group' => 'Profesionales de enfermería  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2222',    'professions_group' => 'Profesionales de partería  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2230',    'professions_group' => 'Profesionales de medicina tradicional y alternativa  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2240',    'professions_group' => 'Paramédicos e instrumentadores quirúrgicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2250',    'professions_group' => 'Veterinarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2261',    'professions_group' => 'Odontólogos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2262',    'professions_group' => 'Farmacéuticos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2263',    'professions_group' => 'Profesionales de la salud y la higiene laboral y ambiental  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2264',    'professions_group' => 'Fisioterapeutas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2265',    'professions_group' => 'Dietistas y nutricionistas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2266',    'professions_group' => 'Fonoaudiólogos y terapeutas del lenguaje  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2267',    'professions_group' => 'Optómetras  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2269',    'professions_group' => 'Otros profesionales de la salud no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2310',    'professions_group' => 'Profesores de instituciones de educación superior  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2320',    'professions_group' => 'Profesores de formación profesional  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2330',    'professions_group' => 'Profesores de educación secundaria  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2341',    'professions_group' => 'Profesores de educación primaria  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2342',    'professions_group' => 'Profesores de primera infancia  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2351',    'professions_group' => 'Especialistas en métodos pedagógicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2352',    'professions_group' => 'Profesores de educación especial e inclusiva  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2353',    'professions_group' => 'Otros profesores de idiomas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2354',    'professions_group' => 'Otros profesores de música  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2355',    'professions_group' => 'Otros profesores de artes  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2356',    'professions_group' => 'Instructores de tecnología de la información  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2359',    'professions_group' => 'Otros profesionales de la educación no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2411',    'professions_group' => 'Contadores  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2412',    'professions_group' => 'Asesores financieros y de inversiones  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2413',    'professions_group' => 'Analistas financieros  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2421',    'professions_group' => 'Analistas de gestión y organización  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2422',    'professions_group' => 'Profesionales en políticas de administración  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2423',    'professions_group' => 'Profesionales de gestión de talento humano  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2424',    'professions_group' => 'Profesionales en formación y desarrollo de personal  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2431',    'professions_group' => 'Profesionales de la publicidad y la comercialización  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2432',    'professions_group' => 'Profesionales de relaciones públicas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2433',    'professions_group' => 'Profesionales de ventas técnicas y médicas (excluyendo las TIC)  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2434',    'professions_group' => 'Profesionales de ventas de tecnología de la información y las comunicaciones  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2511',    'professions_group' => 'Analistas de sistemas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2512',    'professions_group' => 'Desarrolladores de software  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2513',    'professions_group' => 'Desarrolladores web y multimedia  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2514',    'professions_group' => 'Programadores de aplicaciones  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2519',    'professions_group' => 'Desarrolladores y analistas de software y multimedia no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2521',    'professions_group' => 'Diseñadores y administradores de bases de datos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2522',    'professions_group' => 'Administradores de sistemas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2523',    'professions_group' => 'Profesionales en redes de computadores  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2529',    'professions_group' => 'Profesionales en bases de datos y en redes de computadores no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2611',    'professions_group' => 'Abogados  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2612',    'professions_group' => 'Jueces  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2619',    'professions_group' => 'Profesionales en derecho no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2621',    'professions_group' => 'Archivistas y curadores de arte  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2622',    'professions_group' => 'Bibliotecarios, documentalistas y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2631',    'professions_group' => 'Economistas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2632',    'professions_group' => 'Sociólogos, antropólogos y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2633',    'professions_group' => 'Filósofos, historiadores y especialistas en ciencias políticas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2634',    'professions_group' => 'Psicólogos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2635',    'professions_group' => 'Profesionales del trabajo social y consejeros  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2636',    'professions_group' => 'Profesionales religiosos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2641',    'professions_group' => 'Autores y otros escritores  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2642',    'professions_group' => 'Periodistas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2643',    'professions_group' => 'Traductores, intérpretes y otros lingüistas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2651',    'professions_group' => 'Escultores, pintores artísticos y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2652',    'professions_group' => 'Compositores, músicos y cantantes  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2653',    'professions_group' => 'Coreógrafos y bailarines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2654',    'professions_group' => 'Directores y productores de cine, de teatro y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2655',    'professions_group' => 'Actores  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2656',    'professions_group' => 'Locutores de radio, televisión y otros medios de comunicación  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '2659',    'professions_group' => 'Artistas creativos e interpretativos no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3111',    'professions_group' => 'Técnicos en ciencias físicas y químicas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3112',    'professions_group' => 'Técnicos en ingeniería civil  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3113',    'professions_group' => 'Electrotécnicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3114',    'professions_group' => 'Técnicos en electrónica  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3115',    'professions_group' => 'Técnicos en ingeniería mecánica  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3116',    'professions_group' => 'Técnicos en química industrial  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3117',    'professions_group' => 'Técnicos de minas y metalurgia  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3118',    'professions_group' => 'Delineantes y dibujantes técnicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3119',    'professions_group' => 'Técnicos en ciencias físicas y en ingeniería no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3121',    'professions_group' => 'Supervisores de minas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3122',    'professions_group' => 'Supervisores de industrias manufactureras  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3123',    'professions_group' => 'Supervisores de la construcción  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3131',    'professions_group' => 'Operadores de plantas de producción de energía  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3132',    'professions_group' => 'Operadores de incineradores, instalaciones de tratamiento de agua y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3133',    'professions_group' => 'Controladores de instalaciones de procesamiento de productos químicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3134',    'professions_group' => 'Operadores de instalaciones de refinación de petróleo y gas natural  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3135',    'professions_group' => 'Operadores de procesos de producción de metales  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3139',    'professions_group' => 'Técnicos en control de procesos no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3141',    'professions_group' => 'Técnicos en ciencias biológicas (excluyendo la medicina)  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3142',    'professions_group' => 'Técnicos agropecuarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3143',    'professions_group' => 'Técnicos forestales  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3151',    'professions_group' => 'Oficiales maquinistas en navegación  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3152',    'professions_group' => 'Capitanes, oficiales de cubierta y prácticos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3153',    'professions_group' => 'Pilotos de aviación y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3154',    'professions_group' => 'Controladores de tráfico aéreo y marítimo  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3155',    'professions_group' => 'Técnicos  en seguridad aeronáutica  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3211',    'professions_group' => 'Técnicos en aparatos de diagnóstico y tratamiento médico  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3212',    'professions_group' => 'Técnicos de laboratorios médicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3213',    'professions_group' => 'Técnicos y asistentes farmacéuticos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3214',    'professions_group' => 'Técnicos de prótesis médicas y dentales  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3221',    'professions_group' => 'Técnicos y profesionales del nivel medio en enfermería  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3222',    'professions_group' => 'Técnicos y profesionales del nivel medio en partería  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3230',    'professions_group' => 'Técnicos  y profesionales del nivel medio en medicina  tradicional y alternativa  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3240',    'professions_group' => 'Técnicos y asistentes veterinarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3251',    'professions_group' => 'Higienistas y asistentes odontológicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3252',    'professions_group' => 'Técnicos en documentación sanitaria  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3253',    'professions_group' => 'Trabajadores comunitarios de la salud  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3254',    'professions_group' => 'Técnicos en optometría y ópticas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3255',    'professions_group' => 'Técnicos y asistentes  terapeutas  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3256',    'professions_group' => 'Asistentes médicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3257',    'professions_group' => 'Inspectores de seguridad, salud ocupacional,  medioambiental y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3258',    'professions_group' => 'Técnicos en atención prehospitalaria  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3259',    'professions_group' => 'Otros técnicos y profesionales del nivel medio de la salud, no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3311',    'professions_group' => 'Agentes de bolsa, cambio y otros servicios financieros  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3312',    'professions_group' => 'Analistas de préstamos y créditos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3313',    'professions_group' => 'Técnicos de contabilidad y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3314',    'professions_group' => 'Técnicos y profesionales del nivel medio de servicios estadísticos, matemáticos y afines  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3315',    'professions_group' => 'Tasadores y evaluadores  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3321',    'professions_group' => 'Agentes de seguros  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3322',    'professions_group' => 'Representantes comerciales  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3323',    'professions_group' => 'Agentes de compras  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3324',    'professions_group' => 'Agentes de operaciones comerciales y consignatarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3331',    'professions_group' => 'Declarantes o gestores de aduana  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3332',    'professions_group' => 'Organizadores de conferencias y eventos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3333',    'professions_group' => 'Agentes de empleo y contratistas de mano de obra  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3334',    'professions_group' => 'Agentes inmobiliarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3339',    'professions_group' => 'Agentes de servicios comerciales no clasificados en otros grupos primarios  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3341',    'professions_group' => 'Supervisores de oficina  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3342',    'professions_group' => 'Secretarios jurídicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3343',    'professions_group' => 'Secretarios administrativos y ejecutivos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3344',    'professions_group' => 'Secretarios médicos  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3351',    'professions_group' => 'Agentes de aduana e inspectores de frontera  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3352',    'professions_group' => 'Agentes de administración tributaria  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3353',    'professions_group' => 'Agentes de servicios de seguridad social  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3354',    'professions_group' => 'Agentes gubernamentales de  expedición de licencias  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3355',    'professions_group' => 'Inspectores de policía y detectives  '
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3359',    'professions_group' => 'Agentes de gobierno  y profesionales del nivel medio para la aplicación de regulaciones  no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3411',    'professions_group' => 'Técnicos y profesionales del nivel medio del derecho de servicios legales y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3412',    'professions_group' => 'Trabajadores y asistentes sociales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3413',    'professions_group' => 'Auxiliares laicos de las religiones'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3421',    'professions_group' => 'Atletas y deportistas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3422',    'professions_group' => 'Entrenadores, instructores y árbitros de actividades deportivas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3423',    'professions_group' => 'Instructores de educación física y actividades recreativas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3431',    'professions_group' => 'Fotógrafos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3432',    'professions_group' => 'Diseñadores y decoradores de interiores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3433',    'professions_group' => 'Técnicos en galerías de arte, museos y bibliotecas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3434',    'professions_group' => 'Chefs'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3435',    'professions_group' => 'Otros  técnicos y profesionales del nivel medio en actividades culturales y artísticas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3511',    'professions_group' => 'Técnicos  en operaciones de tecnología de la información y las comunicaciones'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3512',    'professions_group' => 'Técnicos  en asistencia y soporte al usuario de tecnología de la información y las comunicaciones'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3513',    'professions_group' => 'Técnicos  en redes y sistemas de computación'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3514',    'professions_group' => 'Técnicos de la Web'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3521',    'professions_group' => 'Técnicos de radiodifusión y grabación audio visual'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '3522',    'professions_group' => 'Técnicos  de ingeniería de las telecomunicaciones'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4110',    'professions_group' => 'Oficinistas generales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4120',    'professions_group' => 'Secretarios generales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4131',    'professions_group' => 'Operadores de máquinas de procesamiento de texto y mecanógrafos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4132',    'professions_group' => 'Grabadores de datos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4211',    'professions_group' => 'Cajeros de bancos y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4212',    'professions_group' => 'Receptores de apuestás y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4213',    'professions_group' => 'Prestamistas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4214',    'professions_group' => 'Cobradores y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4221',    'professions_group' => 'Empleados y consultores de viajes'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4222',    'professions_group' => 'Empleados de centros de llamadas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4223',    'professions_group' => 'Telefonistas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4224',    'professions_group' => 'Recepcionistas de hoteles'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4225',    'professions_group' => 'Empleados de ventanillas de informaciones'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4226',    'professions_group' => 'Recepcionistas generales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4227',    'professions_group' => 'Entrevistadores de encuestás y de investigaciones de mercados'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4229',    'professions_group' => 'Otros empleados de servicios de información al cliente no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4311',    'professions_group' => 'Auxiliares de contabilidad y cálculo de costos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4312',    'professions_group' => 'Auxiliares de servicios estadísticos, financieros y de seguros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4313',    'professions_group' => 'Auxiliares encargados de las nóminas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4321',    'professions_group' => 'Empleados de control de abastecimientos e inventario'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4322',    'professions_group' => 'Empleados de servicios de apoyo a la producción'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4323',    'professions_group' => 'Empleados de servicios de transporte'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4411',    'professions_group' => 'Empleados de bibliotecas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4412',    'professions_group' => 'Empleados de servicios de correos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4413',    'professions_group' => 'Codificadores de datos, correctores de pruebas de imprenta y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4414',    'professions_group' => 'Escribientes públicos y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4415',    'professions_group' => 'Empleados de archivos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4416',    'professions_group' => 'Empleados del servicio de personal'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '4419',    'professions_group' => 'Otro personal de apoyo administrativo no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5111',    'professions_group' => 'Personal de servicio a pasajeros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5112',    'professions_group' => 'Revisores y cobradores de los transportes públicos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5113',    'professions_group' => 'Guías'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5120',    'professions_group' => 'Cocineros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5131',    'professions_group' => 'Meseros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5132',    'professions_group' => 'Bármanes'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5141',    'professions_group' => 'Peluqueros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5142',    'professions_group' => 'Especialistas en tratamientos de belleza y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5151',    'professions_group' => 'Supervisores  de mantenimiento y limpieza en oficinas, hoteles y otros establecimientos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5152',    'professions_group' => 'Mayordomos domésticos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5153',    'professions_group' => 'Conserjes y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5161',    'professions_group' => 'Astrólogos, adivinos y trabajadores afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5162',    'professions_group' => 'Acompañantes'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5163',    'professions_group' => 'Personal de servicios funerarios y embalsamadores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5164',    'professions_group' => 'Cuidadores de animales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5165',    'professions_group' => 'Instructores de conducción'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5169',    'professions_group' => 'Otros trabajadores de servicios personales no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5211',    'professions_group' => 'Vendedores de quioscos y de puestos de mercado'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5212',    'professions_group' => 'Vendedores ambulantes de alimentos preparados para consumo inmediato'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5221',    'professions_group' => 'Comerciantes de tiendas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5222',    'professions_group' => 'Supervisores de tiendas y almacenes'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5223',    'professions_group' => 'Vendedores y auxiliares de venta en tiendas, almacenes y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5230',    'professions_group' => 'Cajeros de comercio, taquilleros y expendedores de boletas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5241',    'professions_group' => 'Modelos de moda, arte y publicidad'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5242',    'professions_group' => 'Demostradores de tiendas, almacenes y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5243',    'professions_group' => 'Vendedores puerta a puerta'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5244',    'professions_group' => 'Vendedores a través de medios tecnológicos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5245',    'professions_group' => 'Expendedores de combustibles para vehículos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5246',    'professions_group' => 'Vendedores de comidas al mostrador'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5249',    'professions_group' => 'Otros vendedores no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5311',    'professions_group' => 'Cuidadores de niños'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5312',    'professions_group' => 'Auxiliares de maestros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5321',    'professions_group' => 'Trabajadores de los cuidados personales en instituciones'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5322',    'professions_group' => 'Trabajadores de los cuidados personales a domicilio'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5329',    'professions_group' => 'Trabajadores de los cuidados personales en servicios de salud no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5411',    'professions_group' => 'Bomberos y rescatistas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5412',    'professions_group' => 'Policías'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5413',    'professions_group' => 'Guardianes de prisión'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5414',    'professions_group' => 'Guardias de seguridad'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '5419',    'professions_group' => 'Personal de los servicios de protección no clasificadosen otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6111',    'professions_group' => 'Agricultores y trabajadores calificados de cultivos extensivos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6112',    'professions_group' => 'Agricultores y trabajadores calificados de plantaciones de árboles y arbustos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6113',    'professions_group' => 'Agricultores y trabajadores calificados de huertas, invernaderos, viveros y jardines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6114',    'professions_group' => 'Agricultores y trabajadores calificados de cultivos mixtos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6121',    'professions_group' => 'Criadores de ganado y trabajadores de la cría de animales domésticos (excepto aves de corral)'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6122',    'professions_group' => 'Avicultores y trabajadores calificados de la avicultura'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6123',    'professions_group' => 'Criadores y trabajadores calificados de la apicultura y la sericicultura'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6129',    'professions_group' => 'Criadores y trabajadores pecuarios calificados, avicultores y criadores de insectos no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6130',    'professions_group' => 'Productores y trabajadores calificados de explotaciones agropecuarias mixtas cuya producción se destina al mercado'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6210',    'professions_group' => 'Trabajadores forestales calificados y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6221',    'professions_group' => 'Trabajadores de explotaciones de acuicultura'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6222',    'professions_group' => 'Pescadores de agua dulce y en aguas costeras'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6223',    'professions_group' => 'Pescadores de alta mar'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6224',    'professions_group' => 'Cazadores y tramperos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6310',    'professions_group' => 'Trabajadores agrícolas de subsistencia'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6320',    'professions_group' => 'Trabajadores pecuarios de subsistencia'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6330',    'professions_group' => 'Trabajadores agropecuarios de subsistencia'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '6340',    'professions_group' => 'Pescadores, cazadores, tramperos y recolectores de subsistencia'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7111',    'professions_group' => 'Constructores de casas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7112',    'professions_group' => 'Albañiles'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7113',    'professions_group' => 'Labrantes, tronzadores y grabadores de piedra'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7114',    'professions_group' => 'Operarios en cemento armado, enfoscadores y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7115',    'professions_group' => 'Carpinteros de armar y de obra blanca'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7119',    'professions_group' => 'Oficiales y operarios de la construcción de obra gruesa y afines no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7121',    'professions_group' => 'Techadores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7122',    'professions_group' => 'Enchapadores, parqueteros y colocadores de suelos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7123',    'professions_group' => 'Revocadores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7124',    'professions_group' => 'Instaladores de material aislante y de insonorización'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7125',    'professions_group' => 'Cristaleros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7126',    'professions_group' => 'Fontaneros e instaladores de tuberías'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7127',    'professions_group' => 'Mecánicos montadores de aire acondicionado y refrigeración'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7131',    'professions_group' => 'Pintores y empapeladores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7132',    'professions_group' => 'Barnizadores y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7133',    'professions_group' => 'Limpiadores de fachadas y deshollinadores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7211',    'professions_group' => 'Moldeadores y macheros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7212',    'professions_group' => 'Soldadores y oxicortadores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7213',    'professions_group' => 'Chapistas y caldereros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7214',    'professions_group' => 'Montadores de estructuras metálicas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7215',    'professions_group' => 'Aparejadores y empalmadores de cables'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7221',    'professions_group' => 'Herreros y forjadores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7222',    'professions_group' => 'Herramentistas y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7223',    'professions_group' => 'Ajustadores y operadores de máquinas herramientas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7224',    'professions_group' => 'Pulidores de metales y afiladores de herramientas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7231',    'professions_group' => 'Mecánicos y reparadores de vehículos de motor'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7232',    'professions_group' => 'Mecánicos y reparadores de sistemas y motores de aeronaves'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7233',    'professions_group' => 'Mecánicos y reparadores de máquinas agrícolas e industriales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7234',    'professions_group' => 'Reparadores de bicicletas y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7311',    'professions_group' => 'Mecánicos y reparadores de instrumentos de precisión'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7312',    'professions_group' => 'Fabricantes y afinadores de instrumentos musicales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7314',    'professions_group' => 'Alfareros y ceramistas (barro y arcilla)'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7315',    'professions_group' => 'Sopladores, modeladores, laminadores, cortadores y pulidores de vidrio'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7316',    'professions_group' => 'Rotulistas, pintores decorativos y grabadores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7321',    'professions_group' => 'Preimpresores y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7322',    'professions_group' => 'Impresores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7323',    'professions_group' => 'Encuadernadores y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7331',    'professions_group' => 'Tejedores con telares'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7332',    'professions_group' => 'Tejedores con agujas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7333',    'professions_group' => 'Otros tejedores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7341',    'professions_group' => 'Cesteros y mimbreros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7342',    'professions_group' => 'Sombrereros artesanales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7351',    'professions_group' => 'Talladores piezas artesanales de madera'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7352',    'professions_group' => 'Decoradores de piezas artesanales en madera'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7361',    'professions_group' => 'Joyeros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7362',    'professions_group' => 'Orfebres y plateros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7363',    'professions_group' => 'Bisuteros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7370',    'professions_group' => 'Artesanos del cuero'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7391',    'professions_group' => 'Artesanos de papel'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7392',    'professions_group' => 'Artesanos del hierro y otros metales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7393',    'professions_group' => 'Artesanos de las semillas y cortezas vegetales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7399',    'professions_group' => 'Artesanos de otros materiales no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7411',    'professions_group' => 'Electricistas de obras y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7412',    'professions_group' => 'Mecánicos y ajustadores electricistas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7413',    'professions_group' => 'Instaladores y reparadores de líneas eléctricas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7421',    'professions_group' => 'Mecánicos y reparadores en electrónica'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7422',    'professions_group' => 'Instaladores y reparadores en tecnología de la información y las comunicaciones'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7511',    'professions_group' => 'Carniceros, pescaderos y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7512',    'professions_group' => 'Panaderos, pasteleros y confiteros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7513',    'professions_group' => 'Operarios de la elaboración de productos lácteos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7514',    'professions_group' => 'Operarios de la conservación de frutas, legumbres, verduras y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7515',    'professions_group' => 'Catadores y clasificadores de alimentos y bebidas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7516',    'professions_group' => 'Preparadores y elaboradores de tabaco y sus productos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7521',    'professions_group' => 'Operarios del tratamiento de la madera'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7522',    'professions_group' => 'Ebanistas y carpinteros (excluye carpinteros de armar y de obra blanca)'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7523',    'professions_group' => 'Ajustadores y operadores de máquinas para trabajar madera'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7531',    'professions_group' => 'Sastres, modistos, peleteros y sombrereros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7532',    'professions_group' => 'Patronistas y cortadores de tela, cuero y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7533',    'professions_group' => 'Costureros, bordadores y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7534',    'professions_group' => 'Tapiceros, colchoneros y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7535',    'professions_group' => 'Apelambradores, pellejeros y curtidores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7536',    'professions_group' => 'Zapateros y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7541',    'professions_group' => 'Buzos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7542',    'professions_group' => 'Dinamiteros y pegadores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7543',    'professions_group' => 'Clasificadores y probadores de productos (excluyendo alimentos y bebidas)'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7544',    'professions_group' => 'Fumigadores y otros controladores de plagas y malas hierbas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '7549',    'professions_group' => 'Otros oficiales, operarios y oficios relacionados no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8111',    'professions_group' => 'Mineros y operadores de instalaciones mineras'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8112',    'professions_group' => 'Operadores de instalaciones de procesamiento de minerales y rocas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8113',    'professions_group' => 'Perforadores y sondistas de pozos y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8114',    'professions_group' => 'Operadores de máquinas para fabricar cemento y otros productos minerales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8121',    'professions_group' => 'Operadores de instalaciones de procesamiento de metales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8122',    'professions_group' => 'Operadores de máquinas pulidoras, galvanizadoras y recubridoras de metales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8131',    'professions_group' => 'Operadores de plantas y máquinas de productos químicos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8132',    'professions_group' => 'Operadores de máquinas para fabricar productos fotográficos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8141',    'professions_group' => 'Operadores de máquinas para fabricar productos de caucho'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8142',    'professions_group' => 'Operadores de máquinas para fabricar productos de material plástico'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8143',    'professions_group' => 'Operadores de máquinas para fabricar productos de papel'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8151',    'professions_group' => 'Operadores de máquinas de preparación de fibras, hilado y devanado'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8152',    'professions_group' => 'Operadores de telares y otras máquinas tejedoras'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8153',    'professions_group' => 'Operadores de máquinas de coser'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8154',    'professions_group' => 'Operadores de máquinas de blanqueamiento, teñido y limpieza de tejidos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8155',    'professions_group' => 'Operadores de máquinas de tratamiento de pieles y cueros'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8156',    'professions_group' => 'Operadores de máquinas para la fabricación de calzado y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8157',    'professions_group' => 'Operadores de máquinas de lavandería'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8159',    'professions_group' => 'Operadores de máquinas para fabricar productos textiles y artículos de piel y cuero no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8160',    'professions_group' => 'Operadores de máquinas para elaborar alimentos y productos afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8171',    'professions_group' => 'Operadores de instalaciones para la preparación de pasta para papel y papel'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8172',    'professions_group' => 'Operadores de instalaciones de procesamiento de la madera'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8181',    'professions_group' => 'Operadores de máquinas y de instalaciones para elaborar productos de vidrio y cerámica'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8182',    'professions_group' => 'Operadores de máquinas de vapor y calderas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8183',    'professions_group' => 'Operadores de máquinas de embalaje, embotellamiento y etiquetado'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8189',    'professions_group' => 'Otros operadores de máquinas y de instalaciones fijas no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8211',    'professions_group' => 'Ensambladores de maquinaria mecánica'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8212',    'professions_group' => 'Ensambladores de equipos eléctricos y electrónicos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8219',    'professions_group' => 'Ensambladores no clasificados bajo otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8311',    'professions_group' => 'Maquinistas de locomotoras'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8312',    'professions_group' => 'Guardafrenos, guardagujas y agentes de maniobras'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8321',    'professions_group' => 'Conductores de motocicletas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8323',    'professions_group' => 'Conductores de camionetas y vehículos livianos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8324',    'professions_group' => 'Conductores de taxis'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8331',    'professions_group' => 'Conductores de buses, microbuses y tranvías'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8332',    'professions_group' => 'Conductores de camiones y vehículos pesados'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8341',    'professions_group' => 'Operadores de maquinaria agrícola y forestal móvil'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8342',    'professions_group' => 'Operadores de máquinas de movimiento de tierras, construcción de vías y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8343',    'professions_group' => 'Operadores de grúas, aparatos elevadores y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8344',    'professions_group' => 'Operadores de montacargas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '8350',    'professions_group' => 'Marineros de cubierta y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9111',    'professions_group' => 'Personal doméstico'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9112',    'professions_group' => 'Aseadores de oficinas, hoteles y otros establecimientos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9121',    'professions_group' => 'Lavanderos y planchadores manuales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9122',    'professions_group' => 'Lavadores de vehículos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9123',    'professions_group' => 'Lavadores de ventanas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9129',    'professions_group' => 'Otro personal de limpieza no clasificados bajo otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9211',    'professions_group' => 'Obreros y peones de explotaciones agrícolas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9212',    'professions_group' => 'Obreros y peones de explotaciones ganaderas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9213',    'professions_group' => 'Obreros y peones de explotaciones agropecuarias'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9214',    'professions_group' => 'Obreros y peones de jardinería y horticultura'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9215',    'professions_group' => 'Obreros y peones forestales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9216',    'professions_group' => 'Obreros y peones de pesca y acuicultura'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9311',    'professions_group' => 'Obreros y peones de minas y canteras'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9312',    'professions_group' => 'Obreros y peones de obras públicas y mantenimiento'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9313',    'professions_group' => 'Obreros y peones de la construcción de edificios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9321',    'professions_group' => 'Empacadores manuales'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9329',    'professions_group' => 'Obreros y peones de la industria manufacturera no clasificados en otros grupos primarios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9331',    'professions_group' => 'Conductores de vehículos accionados a pedal o a brazo'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9332',    'professions_group' => 'Conductores de vehículos y máquinas de tracción animal'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9333',    'professions_group' => 'Obreros y peones de carga'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9334',    'professions_group' => 'Surtidores de estanterías'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9411',    'professions_group' => 'Cocineros de comidas rápidas'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9412',    'professions_group' => 'Ayudantes de cocina'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9510',    'professions_group' => 'Trabajadores ambulantes de servicios y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9520',    'professions_group' => 'Vendedores ambulantes (excluyendo comidas de preparación inmediata)'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9611',    'professions_group' => 'Recolectores de basura y material reciclable'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9612',    'professions_group' => 'Clasificadores de desechos'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9613',    'professions_group' => 'Barrenderos y afines'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9621',    'professions_group' => 'Mensajeros, mandaderos, maleteros y repartidores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9622',    'professions_group' => 'Personas que realizan trabajos varios'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9624',    'professions_group' => 'Acarreadores de agua y recolectores de leña'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9625',    'professions_group' => 'Recolectores de dinero y surtidores de máquinas de venta automática'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9626',    'professions_group' => 'Lectores de medidores'
        // ]);
        // ProfessionsGroup::factory()->create([
        //     'ciuo' => '9629',    'professions_group' => 'Otras ocupaciones elementales no clasificadas en otros grupos primarios'
        // ]);
    }
}
