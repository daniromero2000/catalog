<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CorporatePhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\CorporatePhones\CorporatePhone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'simcard_number' => 1,
            'operator' => 'Claro',
            'phone' => 3183262162,
            'description' => 'Sin descripción'
        ];
    }
}
