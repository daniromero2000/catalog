<?php

namespace Modules\XisfoPay\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContractStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\XisfoPay\Entities\ContractStatuses\ContractStatus::class;

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
