<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GeneralsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(GenresTableSeeder::class);
        $this->call(CivilStatusTableSeeder::class);
        $this->call(EconomicActivityTypesTableSeeder::class);
        $this->call(IdentityTypeTableSeeder::class);
        $this->call(ProfessionsGroupsTableSeeder::class);
        $this->call(ProfessionsListTableSeeder::class);
        $this->call(ReferenceTypeTableSeeder::class);
        $this->call(HousingTableSeeder::class);
        $this->call(RelationshipTableSeeder::class);
        $this->call(ScholarityTableSeeder::class);
        $this->call(StratumsTableSeeder::class);
        $this->call(VehicleBrandTableSeeder::class);
        $this->call(VehicleTypeTableSeeder::class);
        $this->call(MyCountryTableSeeder::class);
        $this->call(MyProvincesTableSeeder::class);
        $this->call(MyCitiesTableSeeder::class);
        $this->call(EpsTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(SocialMediaTableSeeder::class);
    }
}
