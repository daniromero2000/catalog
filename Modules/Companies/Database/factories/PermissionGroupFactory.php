<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\PermissionGroups\PermissionGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name'  => 'Name',
            'group_order' => '1',
            'status' => '1'
        ];      

    }
}