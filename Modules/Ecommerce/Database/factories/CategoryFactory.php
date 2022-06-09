<?php

namespace Modules\Ecommerce\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ecommerce\Entities\Categories\Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $file = UploadedFile::fake()->image('category.png', 600, 600);

        return [
            'name' => 'Categoria',
            'slug' => str_slug('Categoria'),
            'description' => 'Categoria',
            'banner' => 'Sin Banner',
            'cover' => $file->store('categories', ['disk' => 'public']),
            'is_active' => 1
        ];
    }
}
