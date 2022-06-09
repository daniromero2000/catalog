<?php

namespace Modules\XisfoPay\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class XisfoServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\XisfoPay\Entities\XisfoServices\XisfoService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Soporte'
        ];
    }
}
