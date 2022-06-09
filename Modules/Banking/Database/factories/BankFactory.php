<?php

namespace Modules\Banking\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Banking\Entities\Banks\Bank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => 'Citibank',
            'country_id' => 1,
            'is_active'  => 1
        ];
    }
}
