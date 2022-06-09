<?php

namespace Modules\Streamings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StreamingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PermissionsModulesTableSeeder::class);
        $this->call(StreamingTableSeeder::class);
    }
}
