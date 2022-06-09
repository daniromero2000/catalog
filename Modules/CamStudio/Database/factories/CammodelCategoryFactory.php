<?php

namespace Modules\CamStudio\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class CammodelCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\CamStudio\Entities\CammodelCategories\CammodelCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $file = UploadedFile::fake()->image('cammodel_category.png', 600, 600);

        return [
            'name' => 'Latinas',
            'slug' => str_slug('Latinas'),
            'description' => 'Latinas',
            'banner' => 'Sin Banner',
            'cover' => $file->store('cammodel_categories', ['disk' => 'public']),
            'is_active' => 1
        ];
    }
}
