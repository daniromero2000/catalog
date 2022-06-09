<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubsidiaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\Subsidiaries\Subsidiary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => 'Principal',
            'address'       => 'La 72',
            'phone'         => 3183643,
            'opening_hours' => '8: 00 a 12: 00',
            'city_id'       => 1,
            'company_id'       => 1
        ];
    }
}