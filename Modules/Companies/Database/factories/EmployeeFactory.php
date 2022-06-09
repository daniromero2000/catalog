<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\Employees\Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'                 => 'Jarvis',
            'last_name'            => 'Travis',
            'email'                => 'desarrollo@smartcommerce.com.co',
            'subsidiary_id'        => null,
            'employee_position_id' => 1,
            'password'             => bcrypt('secret'),
            'remember_token'       => str_random(10),
            'rh'                   => 'O-',
            'bank_account'       => str_random(10)
        ];
    }
}
