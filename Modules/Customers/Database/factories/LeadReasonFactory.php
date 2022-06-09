<?php

namespace Modules\Customers\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeadReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Customers\Entities\LeadReasons\LeadReason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reason'        => 'Experiencia de usuario',
            'company_id'    => 1
        ];
    }
}
