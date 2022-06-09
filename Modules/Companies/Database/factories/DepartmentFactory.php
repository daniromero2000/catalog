<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\Departments\Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => 'Gestión Humana',
            'phone'      => 3183643,
            'company_id' => 1
        ];
    }
}
