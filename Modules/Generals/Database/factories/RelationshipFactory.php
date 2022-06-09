<?php

namespace Modules\Generals\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RelationshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Generals\Entities\Relationships\Relationship::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'relationship'   => 'Madre'
        ];
    }
}
