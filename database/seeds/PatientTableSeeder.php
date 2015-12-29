<?php

use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Patient::create([
        		'first_name' => 'Joko',
		    	'last_name' => 'Lianto',
		    	'gender' => 'L',
		    	'email' => 'joli@email.com',
		    	'password' => 'joli88',
		    	'enabled' => '1',
		    	'verified' => '1',
		    	'mobile' => '0812345',
		    	'telephone' => '0312345'
        	]);
    }
}
