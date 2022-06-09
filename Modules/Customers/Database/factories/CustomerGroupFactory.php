<?php

namespace Modules\Customers\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Customers\Entities\CustomerGroups\CustomerGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'            => 'Guest',
            'is_user_defined' => 0,
            'code'            => 'guest'
        ];
    }
}
