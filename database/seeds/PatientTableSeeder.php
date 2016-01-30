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
        $data = \App\User::create([
                'first_name' => 'Super',
                'last_name' => 'Administrator',
                'gender' => 'L',
                'email' => 'admin@dokternet.com',
                'password' => Hash::make('1234'),
                'enabled' => '1',
                'verified' => '1',
                'mobile' => '0812345',
                'telephone' => '0312345'
            ]);
        $data->roles()->attach(1);

        $data = \App\User::create([
                'first_name' => 'Joko',
                'last_name' => 'Lianto',
                'gender' => 'L',
                'email' => 'joli@email.com',
                'password' => Hash::make('1234'),
                'enabled' => '1',
                'verified' => '1',
                'mobile' => '0812345',
                'telephone' => '0312345'
            ]);
        $data->roles()->attach(3);
    }
}
