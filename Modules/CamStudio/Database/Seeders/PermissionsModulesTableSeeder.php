<?php

namespace Modules\CamStudio\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        $studio =   PermissionGroup::factory()->create([
            'name'        => 'Studio',
            'group_order' => 6,
            'status'      => 1
        ]);

        $cam_model_categories = Permission::factory()->create([
            //id = 20
            'name'                => 'cam_model_categories',
            'display_name'        => 'Categorías modelos',
            'icon'                => 'ni ni-books',
            'permission_group_id' =>  $studio->id
        ]);

        // Acciones Módulo Categorias modelos
        Action::factory()->create([
            //id = 75
            'permission_id' => $cam_model_categories->id,
            'name'          => 'Ver Categorías Modelos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-categories.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 76
            'permission_id' => $cam_model_categories->id,
            'name'      => 'Crear Categoría Modelo',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodel-categories.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 77
            'permission_id' => $cam_model_categories->id,
            'name'          => 'Editar Categoría Modelo',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-categories.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 78
            'permission_id' => $cam_model_categories->id,
            'name'          => 'Ver Categoría Modelo',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-categories.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 79
            'permission_id' => $cam_model_categories->id,
            'name'          => 'Borrar Categoría Modelo',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodel-categories.destroy',
            'principal'     => 0
        ]);

        $cam_models = Permission::factory()->create([
            //id = 21
            'name'                => 'cam_models',
            'display_name'        => 'Modelos',
            'icon'                => 'fas fa-female',
            'permission_group_id' =>  $studio->id
        ]);

        // Acciones Módulo modelos
        Action::factory()->create([
            //id = 80
            'permission_id' => $cam_models->id,
            'name'          => 'Ver Modelos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodels.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 81
            'permission_id' => $cam_models->id,
            'name'      => 'Crear Modelo',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodels.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 82
            'permission_id' => $cam_models->id,
            'name'          => 'Editar Modelo',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodels.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 83
            'permission_id' => $cam_models->id,
            'name'          => 'Ver Modelo',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodels.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 84
            'permission_id' => $cam_models->id,
            'name'          => 'Borrar Modelo',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodels.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo perfil modelo
        Action::factory()->create([
            //id = 85
            'permission_id' => $cam_models->id,
            'name'          => 'Ver perfil',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodels.profile',
            'principal'     => 1
        ]);

        $cammodel_social =  Permission::factory()->create([
            //id = 25
            'name'                => 'cammodel_social',
            'display_name'        => 'Redes modelos',
            'icon'                => 'fas fa-share-alt',
            'permission_group_id' =>  $studio->id
        ]);

        // Acciones Módulo CamModel Social
        Action::factory()->create([
            //id = 97
            'permission_id' => $cammodel_social->id,
            'name'          => 'Ver Redes Sociales',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-social.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 98
            'permission_id' => $cammodel_social->id,
            'name'      => 'Crear Red Social',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodel-social.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 99
            'permission_id' => $cammodel_social->id,
            'name'          => 'Editar Red Social',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-social.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 100
            'permission_id' => $cammodel_social->id,
            'name'          => 'Borrar Red Social',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodel-social.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo CamStudio social Stats
        Action::factory()->create([
            //id = 198
            'permission_id' => $cammodel_social->id,
            'name'          => 'Ver Estadísticas Redes Sociales',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.social-stats.index',
            'principal'     => 1
        ]);

        $cammodel_streamings =  Permission::factory()->create([
            //id = 26
            'name'                => 'cammodel_streamings',
            'display_name'        => 'Streamings modelos',
            'icon'                => 'fas fa-satellite-dish',
            'permission_group_id' =>  $studio->id
        ]);

        // Acciones Módulo CamModel Social
        Action::factory()->create([
            //id = 101
            'permission_id' => $cammodel_streamings->id,
            'name'          => 'Ver Streamings',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-streamings.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 102
            'permission_id' => $cammodel_streamings->id,
            'name'      => 'Crear Streaming',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodel-streamings.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 103
            'permission_id' => $cammodel_streamings->id,
            'name'          => 'Editar Streaming',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-streamings.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 104
            'permission_id' => $cammodel_streamings->id,
            'name'          => 'Borrar Streaming',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodel-streamings.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo CamStudio Streaming Stats
        Action::factory()->create([
            //id = 197
            'permission_id' => $cammodel_streamings->id,
            'name'          => 'Ver Estadísticas de Streamings',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.streaming-stats.index',
            'principal'     => 1
        ]);

        $banned_countries =  Permission::factory()->create([
            //id = 29
            'name'                => 'banned_countries',
            'display_name'        => 'Países bloqueados',
            'icon'                => 'fas fa-satellite-dish',
            'permission_group_id' =>  $studio->id
        ]);

        // Acciones Módulo Paises Bloqueadps
        Action::factory()->create([
            //id = 114
            'permission_id' => $banned_countries->id,
            'name'          => 'Ver Países Bloqueados',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.banned-countries.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 115
            'permission_id' => $banned_countries->id,
            'name'      => 'Crear País Bloqueado',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.banned-countries.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 116
            'permission_id' => $banned_countries->id,
            'name'          => 'Editar País Bloqueado',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.banned-countries.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 117
            'permission_id' => $banned_countries->id,
            'name'          => 'Borrar País Bloqueado',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.banned-countries.destroy',
            'principal'     => 0
        ]);

        $cammodel_payrolls =  Permission::factory()->create([
            //id = 49
            'name'                => 'cammodel_payrolls',
            'display_name'        => 'Nomina Modelos',
            'icon'                => 'fas fa-twitter',
            'permission_group_id' =>  $studio->id
        ]);

        // Acciones Módulo Nómina de Modelos
        Action::factory()->create([
            //id = 199
            'permission_id' => $cammodel_payrolls->id,
            'name'          => 'Ver Nóminas Modelos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-payrolls.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 200
            'permission_id' => $cammodel_payrolls->id,
            'name'      => 'Crear Nómina Modelos',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodel-payrolls.create',
            'principal' => 1
        ]);

        Action::factory()->create([
            //id = 201
            'permission_id' => $cammodel_payrolls->id,
            'name'          => 'Editar Nómina Modelo',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-payrolls.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 202
            'permission_id' => $cammodel_payrolls->id,
            'name'          => 'Ver Nómina Modelo',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-payrolls.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 203
            'permission_id' => $cammodel_payrolls->id,
            'name'          => 'Borrar Nómina Modelo',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodel-payrolls.destroy',
            'principal'     => 0
        ]);

        $rooms = Permission::factory()->create([
            //id = 51
            'name'                => 'rooms',
            'display_name'        => 'Rooms',
            'icon'                => 'fas fa-door-closed',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Módulo Rooms
        Action::factory()->create([
            //id = 209
            'permission_id' => $rooms->id,
            'name'          => 'Ver Rooms',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.rooms.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 210
            'permission_id' => $rooms->id,
            'name'          => 'Crear Rooms',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.rooms.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 211
            'permission_id' => $rooms->id,
            'name'          => 'Editar Room',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.rooms.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 212
            'permission_id' => $rooms->id,
            'name'          => 'Ver Room',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.rooms.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 213
            'permission_id' => $rooms->id,
            'name'          => 'Borrar Room',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.rooms.destroy',
            'principal'     => 0
        ]);

        $cammodel_work_reports = Permission::factory()->create([
            //id = 53
            'name'                => 'cammodel_work_reports',
            'display_name'        => 'Reportes de Trabajo',
            'icon'                => 'fas fa-clipboard-list',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Módulo Reportes de Trabajo
        Action::factory()->create([
            //id = 219
            'permission_id' => $cammodel_work_reports->id,
            'name'          => 'Ver Reportes de Trabajo',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-work-reports.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 220
            'permission_id' => $cammodel_work_reports->id,
            'name'          => 'Crear Reporte de Trabajo',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.cammodel-work-reports.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 221
            'permission_id' => $cammodel_work_reports->id,
            'name'          => 'Editar Reporte de Trabajo',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-work-reports.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 222
            'permission_id' => $cammodel_work_reports->id,
            'name'          => 'Ver Reporte de Trabajo',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-work-reports.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 223
            'permission_id' => $cammodel_work_reports->id,
            'name'          => 'Borrar Reporte de Trabajo',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.cammodel-work-reports.destroy',
            'principal'     => 0
        ]);

        $cammodel_streaming_incomes =  Permission::factory()->create([
            //id = 54
            'name'                => 'cammodel_streaming_incomes',
            'display_name'        => 'Registro de Ventas',
            'icon'                => 'fas fa-file-invoice-dollar',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Módulo Registros de Ventas
        Action::factory()->create([
            //id = 224
            'permission_id' => $cammodel_streaming_incomes->id,
            'name'          => 'Ver Registros de Ventas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-streaming-incomes.index',
            'principal'     => 1
        ]);
        Action::factory()->create([
            //id = 239
            'permission_id' => $cammodel_streaming_incomes->id,
            'name'          => 'Reportar Turno',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.cammodel-work-reports.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 225
            'permission_id' => $cammodel_streaming_incomes->id,
            'name'          => 'Crear Registro de Ventas',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.cammodel-streaming-incomes.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 226
            'permission_id' => $cammodel_streaming_incomes->id,
            'name'          => 'Editar Registro de Ventas',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-streaming-incomes.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 227
            'permission_id' => $cammodel_streaming_incomes->id,
            'name'          => 'Ver Registro de Ventas',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-streaming-incomes.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 228
            'permission_id' => $cammodel_streaming_incomes->id,
            'name'          => 'Borrar Registro de Ventas',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.cammodel-streaming-incomes.destroy',
            'principal'     => 0
        ]);

        $fouls = Permission::factory()->create([
            //id = 55
            'name'                => 'fouls',
            'display_name'        => 'Faltas',
            'icon'                => 'fas fa-ban',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Módulo Faltas
        Action::factory()->create([
            //id = 229
            'permission_id' => $fouls->id,
            'name'          => 'Ver Faltas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.fouls.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 230
            'permission_id' => $fouls->id,
            'name'          => 'Crear Faltas',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.fouls.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 231
            'permission_id' => $fouls->id,
            'name'          => 'Editar Falta',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.fouls.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 232
            'permission_id' => $fouls->id,
            'name'          => 'Ver Falta',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.fouls.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 233
            'permission_id' => $fouls->id,
            'name'          => 'Borrar Falta',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.fouls.destroy',
            'principal'     => 0
        ]);

        $cammodel_fines = Permission::factory()->create([
            //id = 56
            'name'                => 'cammodel_fines',
            'display_name'        => 'Multas',
            'icon'                => 'fas fa-creative-commons-nc',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Módulo Multas
        Action::factory()->create([
            //id = 234
            'permission_id' => $cammodel_fines->id,
            'name'          => 'Ver Multas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-fines.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 235
            'permission_id' => $cammodel_fines->id,
            'name'          => 'Crear Multas',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.cammodel-fines.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 236
            'permission_id' => $cammodel_fines->id,
            'name'          => 'Editar Multa',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-fines.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 237
            'permission_id' => $cammodel_fines->id,
            'name'          => 'Ver Multa',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-fines.show',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 238
            'permission_id' => $cammodel_fines->id,
            'name'          => 'Borrar Multa',
            'icon'          => 'fas fa-trash',
            'route'         => 'admin.cammodel-fines.destroy',
            'principal'     => 0
        ]);

        $cammodel_stats = Permission::factory()->create([
            //id = 57
            'name'                => 'cammodel_stats',
            'display_name'        => 'Estadísticas Modelo',
            'icon'                => 'fas fa-signal',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Estadisticas Modelo
        Action::factory()->create([
            //id = 240
            'permission_id' => $cammodel_stats->id,
            'name'          => 'Ver Estadísticas',
            'icon'          => 'fas fa-signal',
            'route'         => 'admin.cammodel-stats.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 241
            'permission_id' => $cammodel_stats->id,
            'name'          => 'Ver Stats Modelo',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-stats.show',
            'principal'     => 0
        ]);

        $camstudio_reports = Permission::factory()->create([
            //id = 59
            'name'                => 'camstudio_reports',
            'display_name'        => 'Reportes de Estudio',
            'icon'                => 'fas fa-check',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Módulo Reportes de Estudio
        Action::factory()->create([
            //id = 244
            'permission_id' => $camstudio_reports->id,
            'name'          => 'Ver Reportes Mensuales',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.camstudio-reports.month',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 245
            'permission_id' => $camstudio_reports->id,
            'name'          => 'Ver Reportes Trimestrales',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.camstudio-reports.trimester',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 249
            'permission_id' => $camstudio_reports->id,
            'name'          => 'Ver Reportes de Managers',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.camstudio-reports.manager',
            'principal'     => 1
        ]);

        $cammodel_tippers = Permission::factory()->create([
            //id = 56
            'name'                => 'cammodel_tippers',
            'display_name'        => 'Tippers',
            'icon'                => 'fas fa-check',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Módulo Tippers
        Action::factory()->create([
            //id = 234
            'permission_id' => $cammodel_tippers->id,
            'name'          => 'Ver Tippers',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-tippers.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 235
            'permission_id' => $cammodel_tippers->id,
            'name'          => 'Crear Tipper',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.cammodel-tippers.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 236
            'permission_id' => $cammodel_tippers->id,
            'name'          => 'Editar Tipper',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-tippers.edit',
            'principal'     => 0
        ]);

        Action::factory()->create([
            //id = 237
            'permission_id' => $cammodel_tippers->id,
            'name'          => 'Ver Tipper',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-tippers.show',
            'principal'     => 0
        ]);

        $cammodel_tipper_social_medias = Permission::factory()->create([
            //id = 56
            'name'                => 'cammodel_tipper_social_medias',
            'display_name'        => 'Redes Tippers',
            'icon'                => 'fas fa-check',
            'permission_group_id' =>  $studio->id
        ]);

        //Acciones Módulo Redes Tipper
        Action::factory()->create([
            //id = 234
            'permission_id' => $cammodel_tipper_social_medias->id,
            'name'          => 'Ver Redes Tippers',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-tipper-social-medias.index',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 235
            'permission_id' => $cammodel_tipper_social_medias->id,
            'name'          => 'Crear Redes Tipper',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.cammodel-tipper-social-medias.create',
            'principal'     => 1
        ]);

        Action::factory()->create([
            //id = 236
            'permission_id' => $cammodel_tipper_social_medias->id,
            'name'          => 'Editar Redes Tipper',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-tipper-social-medias.edit',
            'principal'     => 0
        ]);
    }
}
