<?php

namespace Modules\Generals\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Generals\Entities\Countries\Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      => 'Colombia',
            'iso'       => 'CO',
            'iso3'      => 'COL',
            'numcode'   => 170,
            'phonecode' => 57,
            'is_active'    => 1
        ];
    }
}
