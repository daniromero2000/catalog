<?php

namespace Modules\PawnShop\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JewelryQualityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\PawnShop\Entities\JewelryQualities\JewelryQuality::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => '18',
            'price' => 10000
        ];
    }
}
