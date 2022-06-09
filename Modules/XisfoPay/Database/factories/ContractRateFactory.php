<?php

namespace Modules\XisfoPay\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContractRateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\XisfoPay\Entities\ContractRates\ContractRate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'percentage' => '5%',
            'type'       => 0,
            'value'      => 0.05,
            'is_aprobed' => 1,
            'is_active'  => 1
        ];
    }
}
