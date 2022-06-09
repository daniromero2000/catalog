<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\Roles\Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'         => 'Name',
            'display_name' => '',
            'description'  => ''
        ];
    }
}
