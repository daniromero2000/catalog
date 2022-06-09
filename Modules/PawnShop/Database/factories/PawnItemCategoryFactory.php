<?php

namespace Modules\PawnShop\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PawnItemCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\PawnShop\Entities\PawnItemCategories\PawnItemCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Vehículos'
        ];
    }
}
