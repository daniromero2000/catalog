<?php

namespace Modules\Ecommerce\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ecommerce\Entities\Brands\Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'SmartCommerce',
            'slug' => str_slug('SmartCommerce')
        ];
    }
}
