<?php

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Province::create([
                'name' => 'Jawa Timur',
            ]);
        \App\Province::create([
                'name' => 'Jawa Tengah',
            ]);
        \App\Province::create([
                'name' => 'Jawa Barat',
            ]);
        \App\Province::create([
                'name' => 'Bali',
            ]);
    }
}
