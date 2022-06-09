<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\Actions\Action::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'permission_id' => 1,
            'name'          => 'name',
            'icon'          => 'fas fa-user-tie',
            'route'         => 'admin.actions',
            'principal'     => 1
        ];
    }
}