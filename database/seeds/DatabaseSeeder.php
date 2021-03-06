<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PatientTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(SpecializationTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(DayTableSeeder::class);
        
        
        Model::reguard();
    }
}
