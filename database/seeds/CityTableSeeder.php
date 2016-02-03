<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\City::create([
                'province_id' => '1',
                'name' => 'Surabaya',
            ]);
        \App\City::create([
                'province_id' => '1',
                'name' => 'Mojokerto',
            ]);
        \App\City::create([
                'province_id' => '1',
                'name' => 'Malang',
            ]);
        \App\City::create([
                'province_id' => '1',
                'name' => 'Banyuwangi',
            ]);
    }
}
