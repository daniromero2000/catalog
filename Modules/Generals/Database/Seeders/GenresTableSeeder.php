<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Genres\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        Genre::factory()->create([
            'genre'  => 'Hombre'
        ]);

        Genre::factory()->create([
            'genre'  => 'Mujer'
        ]);

        Genre::factory()->create([
            'genre'  => 'Otro'
        ]);
    }
}
