<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([
        	'code' => 'AD',
        	'name' => 'Administrator',
        	'locked' => '1',
        	'enabled' => '1',
        	'default' => '0'
        	]);
        \App\Role::create([
        	'code' => 'DC',
        	'name' => 'Doctor',
        	'locked' => '0',
        	'enabled' => '1',
        	'default' => '0'
        	]);
       	\App\Role::create([
        	'code' => 'PT',
        	'name' => 'Patient',
        	'locked' => '0',
        	'enabled' => '1',
        	'default' => '1'
        	]);
    }
}
