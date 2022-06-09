<?php

//config for Laratrust

use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Roles\Role;
use Modules\Companies\Entities\Teams\Team;

return [

    'user_models' => [
        'users' => Employee::class,
    ],

    'models' => [
        /**
         * Role model
         */
        'role' => Role::class,

        /**
         * Permission model
         */
        'permission' => Permission::class,

        /**
         * Team model
         */
        'team' => Team::class,

    ],


];


//config for Auth

return [

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        'checkout' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver'   => 'token',
            'provider' => 'users',
            'hash'     => false,
        ],

        'employee' => [
            'driver'   => 'session',
            'provider' => 'employee',
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => Modules\Customers\Entities\Customers\Customer::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],

        'employee' => [
            'driver' => 'eloquent',
            'model'  => Modules\Companies\Entities\Employees\Employee::class,
        ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_resets',
            'expire'   => 60,
        ],

        'employee' => [
            'provider' => 'employee',
            'table'    => 'password_resets',
            'expire'   => 60,
        ],
    ],


];


//config for loggin -> add this channels

return [

    'login' => [
        'driver' => 'single',
        'name' => 'login',
        'path' => storage_path('logs/logins.log'),
    ],

    'leads' => [
        'driver' => 'single',
        'name' => 'leads',
        'path' => storage_path('logs/leads.log'),
    ],
];
