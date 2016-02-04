<?php

use Illuminate\Database\Seeder;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\App\SpecializationCategory::create([
    		'name' => 'Anak'
    		]);
    	\App\SpecializationCategory::create([
    		'name' => 'Gigi'
    		]);
    	\App\SpecializationCategory::create([
    		'name' => 'Jantung'
    		]);
        \App\Specialization::create([
        	'name' => 'Anak (Jantung)',
        	'specialization_category_id' => '1'
        	]);
        \App\Specialization::create([
        	'name' => 'Anak (Kulit)',
        	'specialization_category_id' => '1'
        	]);
        \App\Specialization::create([
        	'name' => 'Bedah Mulut',
        	'specialization_category_id' => '2'
        	]);
        \App\Specialization::create([
        	'name' => 'Penyakit Gigi',
        	'specialization_category_id' => '2'
        	]);
        \App\Specialization::create([
        	'name' => 'Psikiatri Remaja',
        	'specialization_category_id' => '3'
        	]);

    }
}
