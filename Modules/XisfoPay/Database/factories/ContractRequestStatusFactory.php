<?php

namespace Modules\XisfoPay\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContractRequestStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\XisfoPay\Entities\ContractRequestStatuses\ContractRequestStatus::class;

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
