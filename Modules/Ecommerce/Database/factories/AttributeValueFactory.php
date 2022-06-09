<?php

namespace Modules\Ecommerce\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ecommerce\Entities\AttributeValues\AttributeValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value'      => 'S',
            'sort_order' => 1
        ];
    }
}
