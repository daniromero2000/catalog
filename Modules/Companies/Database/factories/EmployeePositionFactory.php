<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeePositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\EmployeePositions\EmployeePosition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position' => 'Coordinador'
        ];
    }
}
