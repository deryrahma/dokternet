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

        $data = \App\User::create([
                'email' => 'medcen@email.com',
                'password' => Hash::make('1234'),
                'enabled' => '1',
                'verified' => '1',
                'telephone' => '0315998314'
            ]);
        \App\Clinic::create( [
            'user_id'   => $data->id,
            'city_id'   => 1,
            'name'      => 'Medical Center ITS',
            'address'   => 'Kompleks Poliklinik Kampus ITS Jl. Arif Rahman Hakim Surabaya',
            'latitude'  => '-7.2902946',
            'longitude' => '112.7928178',
            'telephone' => $data->telephone,
            'email'     => $data->email,
            'password'  => $data->password,
        ] );
        $data->roles()->attach(4);
        $data = \App\User::create([
                'email' => 'doctor@email.com',
                'password' => Hash::make('1234'),
                'enabled' => '1',
                'verified' => '1',
                'telephone' => '0315998314'
            ]);
        $doctor = \App\Doctor::create( [
            'user_id'   => $data->id,
            'city_id'   => 1,
            'specialization_id' => '1',
            'name'      => 'dr. Joko Lianto',
            'address'   => 'Kompleks Poliklinik Kampus ITS Jl. Arif Rahman Hakim Surabaya',
            'latitude'  => '-7.2902946',
            'longitude' => '112.7928178',
            'telephone' => $data->telephone
        ] );
        $data->roles()->attach(2);
        $doctor->clinics()->attach(1);
        \App\DoctorEducation::create([
            'doctor_id' => $doctor->id,
            'year'  => '2016',
            'name'  => 'S1 Teknik Informatika ITS'
            ]);
    }
}
