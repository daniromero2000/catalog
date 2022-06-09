<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CustomerGroupTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        DB::table('customer_groups')->delete();

        DB::table('customer_groups')->insert([
            [
                'id'              => 1,
                'code'            => 'guest',
                'name'            => 'Guest',
                'is_user_defined' => 0,
            ], [
                'id'              => 2,
                'code'            => 'general',
                'name'            => 'General',
                'is_user_defined' => 0
            ], [
                'id'              => 3,
                'code'            => 'wholesale',
                'name'            => 'Wholesale',
                'is_user_defined' => 0,
            ], [
                'id'              => 4,
                'code'            => 'modelo',
                'name'            => 'Modelo',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 5,
                'code'            => 'estudio',
                'name'            => 'Estudio',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 6,
                'code'            => 'satelite_estudio',
                'name'            => 'Satelite_estudio',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 7,
                'code'            => 'empleado',
                'name'            => 'Empleado',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 8,
                'code'            => 'ecommerce',
                'name'            => 'Ecommerce',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 9,
                'code'            => 'nuevo',
                'name'            => 'Nuevo',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 10,
                'code'            => 'token_sales',
                'name'            => 'Venta Tokens',
                'is_user_defined' => 0,
            ]
        ]);
    }
}
