<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\Permissions\Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name'                => 'employees',
            'display_name'        => 'Empleados',
            'icon'                => 'fas fa-user-tie',
            'permission_group_id' => 1
        ];
    }
}