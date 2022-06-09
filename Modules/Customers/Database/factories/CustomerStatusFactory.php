<?php

namespace Modules\Customers\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Customers\Entities\CustomerStatuses\CustomerStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => 'Cerrado',
            'color' => 'ffffff'
        ];
    }
}
