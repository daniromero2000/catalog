<?php

namespace Modules\CamStudio\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;

class CamModelCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        CammodelCategory::factory()->create();
    }
}
