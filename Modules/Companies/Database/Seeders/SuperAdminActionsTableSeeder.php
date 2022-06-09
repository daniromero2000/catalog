<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\ActionRole\ActionRole;
use Modules\Companies\Entities\Actions\Action;

class SuperAdminActionsTableSeeder extends Seeder
{
    public function run()
    {
        $actions   = Action::pluck('id')->all();

        foreach ($actions as $key => $action) {
            ActionRole::factory()->create([
                'action_id' => $action,
                'role_id' => 1
            ]);
        }


        // // Permisos Acciones Módulo Empleados
        // ActionRole::factory()->create([
        //     'action_id' => 1,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 2,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 3,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 4,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 5,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Ciudades
        // ActionRole::factory()->create([
        //     'action_id' => 6,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 7,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Sucursales
        // ActionRole::factory()->create([
        //     'action_id' => 8,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 9,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 10,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 11,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 12,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Roles
        // ActionRole::factory()->create([
        //     'action_id' => 13,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 14,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 15,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 16,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Permisos
        // ActionRole::factory()->create([
        //     'action_id' => 17,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 18,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 19,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 20,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Pqrs
        // ActionRole::factory()->create([
        //     'action_id' => 21,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 22,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 23,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 24,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 25,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Pqrs Statuses
        // ActionRole::factory()->create([
        //     'action_id' => 26,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 27,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 28,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 29,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Customer
        // ActionRole::factory()->create([
        //     'action_id' => 30,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 31,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 32,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 33,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 34,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Customer Statuses
        // ActionRole::factory()->create([
        //     'action_id' => 35,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 36,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 37,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 38,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo actions
        // ActionRole::factory()->create([
        //     'action_id' => 39,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 40,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 41,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 42,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Productos
        // ActionRole::factory()->create([
        //     'action_id' => 43,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 44,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 45,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 46,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Categorías
        // ActionRole::factory()->create([
        //     'action_id' => 47,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 48,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 49,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 50,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 51,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Atributos
        // ActionRole::factory()->create([
        //     'action_id' => 52,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 53,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 54,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 55,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 56,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo marcas
        // ActionRole::factory()->create([
        //     'action_id' => 57,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 58,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 59,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 60,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Ordenes
        // ActionRole::factory()->create([
        //     'action_id' => 61,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 62,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 63,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 64,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Wishlists
        // ActionRole::factory()->create([
        //     'action_id' => 65,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 66,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Checkouts
        // ActionRole::factory()->create([
        //     'action_id' => 67,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 68,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo despachos
        // ActionRole::factory()->create([
        //     'action_id' => 69,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 70,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 71,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 72,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Calificacion de productos
        // ActionRole::factory()->create([
        //     'action_id' => 73,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 74,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo categorias modelos
        // ActionRole::factory()->create([
        //     'action_id' => 75,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 76,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 77,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 78,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 79,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo modelos
        // ActionRole::factory()->create([
        //     'action_id' => 80,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 81,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 82,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 83,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 84,
        //     'role_id' => 1
        // ]);

        // // Permisos Accion Módulo modelos perfil modelo
        // ActionRole::factory()->create([
        //     'action_id' => 85,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones suscripciones
        // ActionRole::factory()->create([
        //     'action_id' => 86,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 87,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Entrevistas
        // ActionRole::factory()->create([
        //     'action_id' => 88,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 89,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 90,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 91,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 92,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Estados Entrevistas
        // ActionRole::factory()->create([
        //     'action_id' => 93,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 94,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 95,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 96,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Cammodel Socials
        // ActionRole::factory()->create([
        //     'action_id' => 97,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 98,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 99,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 100,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Cammodel Streamings
        // ActionRole::factory()->create([
        //     'action_id' => 101,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 102,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 103,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 104,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Leads
        // ActionRole::factory()->create([
        //     'action_id' => 105,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 106,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 107,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 108,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 109,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Leads Statuses
        // ActionRole::factory()->create([
        //     'action_id' => 110,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 111,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 112,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 113,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Paises bloqueados
        // ActionRole::factory()->create([
        //     'action_id' => 114,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 115,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 116,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 117,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Estados de Contrato
        // ActionRole::factory()->create([
        //     'action_id' => 118,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 119,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 120,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 121,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Estados de solicitudes de Contrato
        // ActionRole::factory()->create([
        //     'action_id' => 122,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 123,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 124,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 125,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo tarifas de Contrato
        // ActionRole::factory()->create([
        //     'action_id' => 126,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 127,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 128,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 129,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Contratos
        // ActionRole::factory()->create([
        //     'action_id' => 130,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 131,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 132,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 133,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 134,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Solicitudes Contratos
        // ActionRole::factory()->create([
        //     'action_id' => 135,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 136,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 137,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 138,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 139,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo renovaciones Contratos
        // ActionRole::factory()->create([
        //     'action_id' => 140,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 141,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 142,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 143,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Estados solicitudes de pagos
        // ActionRole::factory()->create([
        //     'action_id' => 144,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 145,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 146,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 147,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Solicitud de Pagos
        // ActionRole::factory()->create([
        //     'action_id' => 148,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 149,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 150,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 151,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 152,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo bancos
        // ActionRole::factory()->create([
        //     'action_id' => 153,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 154,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 155,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 156,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Cuentas Streaming Clientes
        // ActionRole::factory()->create([
        //     'action_id' => 157,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 158,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 159,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 160,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Cortes de pago
        // ActionRole::factory()->create([
        //     'action_id' => 161,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 162,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 163,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 164,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 165,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo streamings
        // ActionRole::factory()->create([
        //     'action_id' => 166,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 167,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 168,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 169,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Transferencias Bancarias
        // ActionRole::factory()->create([
        //     'action_id' => 170,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 171,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 172,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo avances Solicitud de Pagos
        // ActionRole::factory()->create([
        //     'action_id' => 173,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 174,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 175,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 176,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo cuentas bancos clientes
        // ActionRole::factory()->create([
        //     'action_id' => 177,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 178,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 179,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 180,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Servicios Xisfo
        // ActionRole::factory()->create([
        //     'action_id' => 181,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 182,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 183,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 184,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo Empresas Clientes
        // ActionRole::factory()->create([
        //     'action_id' => 185,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 186,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 187,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 188,
        //     'role_id' => 1
        // ]);

        // // Acciones Módulo TRM Cortes de pago
        // ActionRole::factory()->create([
        //     'action_id' => 189,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 190,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 191,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 192,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Corporate Phones
        // ActionRole::factory()->create([
        //     'action_id' => 193,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 194,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 195,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 196,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Streaming Stats
        // ActionRole::factory()->create([
        //     'action_id' => 197,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Social Stats
        // ActionRole::factory()->create([
        //     'action_id' => 198,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Cammodel Payrolls
        // ActionRole::factory()->create([
        //     'action_id' => 199,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 200,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 201,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 202,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 203,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Goals
        // ActionRole::factory()->create([
        //     'action_id' => 204,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 205,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 206,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 207,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 208,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Rooms
        // ActionRole::factory()->create([
        //     'action_id' => 209,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 210,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 211,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 212,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 213,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Shifts
        // ActionRole::factory()->create([
        //     'action_id' => 214,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 215,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 216,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 217,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 218,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Work Reports
        // ActionRole::factory()->create([
        //     'action_id' => 219,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 220,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 221,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 222,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 223,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Streaming Incomes
        // ActionRole::factory()->create([
        //     'action_id' => 224,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 225,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 226,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 227,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 228,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Fouls
        // ActionRole::factory()->create([
        //     'action_id' => 229,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 230,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 231,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 232,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 233,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Cammodel Fines
        // ActionRole::factory()->create([
        //     'action_id' => 234,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 235,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 236,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 237,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 238,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo PawnItems
        // ActionRole::factory()->create([
        //     'action_id' => 242,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 243,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 244,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 245,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 246,
        //     'role_id' => 1
        // ]);

        // // Permisos Acciones Módulo Tarifas Fasecolda
        // ActionRole::factory()->create([
        //     'action_id' => 247,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 248,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 249,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 250,
        //     'role_id' => 1
        // ]);

        // ActionRole::factory()->create([
        //     'action_id' => 251,
        //     'role_id' => 1
        // ]);
    }
}
