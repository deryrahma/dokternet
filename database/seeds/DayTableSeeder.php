<?php

use Illuminate\Database\Seeder;

class DayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Day::truncate();
        \App\Day::create(
        	['name' => 'Minggu']
        	);
        \App\Day::create(
        	['name' => 'Senin']
        	);
        \App\Day::create(
        	['name' => 'Selasa']
        	);
       	\App\Day::create(
        	['name' => 'Rabu']
        	);
       	\App\Day::create(
        	['name' => 'Kamis']
        	);
       	\App\Day::create(
        	['name' => 'Jumat']
        	);
       	\App\Day::create(
        	['name' => 'Sabtu']
        	);
    }
}
