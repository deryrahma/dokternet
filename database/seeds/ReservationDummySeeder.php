<?php

use Illuminate\Database\Seeder;

class ReservationDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Run at terminal:
     * $  php artisan db:seed --class=ReservationDummySeeder
     *
     * @return void
     */
    public function run()
    {
        \App\Schedule::create( [
          'clinic_id'       => 1,
          'doctor_id'       => 1,
          'schedule_start'  => '08:00:00',
          'schedule_end'    => '18:00:00',
          'date'            => date( "Y-m-d", strtotime( "+2 day" ) ),
          'quota'           => 0,
          'status_batal'    => 0,
        ] );
        \App\Schedule::create( [
          'clinic_id'       => 2,
          'doctor_id'       => 1,
          'schedule_start'  => '08:00:00',
          'schedule_end'    => '18:00:00',
          'date'            => date( "Y-m-d" ),
          'quota'           => 10,
          'status_batal'    => 0,
        ] );
        \App\Schedule::create( [
          'clinic_id'       => 1,
          'doctor_id'       => 1,
          'schedule_start'  => '08:00:00',
          'schedule_end'    => '10:00:00',
          'date'            => date( "Y-m-d", strtotime( "+1 day" ) ),
          'quota'           => 2,
          'status_batal'    => 1,
        ] );
        \App\Schedule::create( [
          'clinic_id'       => 1,
          'doctor_id'       => 1,
          'schedule_start'  => '13:00:00',
          'schedule_end'    => '18:00:00',
          'date'            => date( "Y-m-d", strtotime( "+1 day" ) ),
          'quota'           => 5,
          'status_batal'    => 0,
        ] );
        \App\Clinic::create( [
          'city_id'   => 1,
          'name'      => 'RSU Haji',
          'address'   => 'Sukolilo',
          'latitude'  => '-7.265757',
          'longitude' => '112.734146',
          'telephone' => '081234567890',
          'email'     => '5345678',
        ] );
        \App\Clinic::create( [
          'city_id'   => 1,
          'name'      => 'RSAL',
          'address'   => 'Mayjend Sungkono',
          'latitude'  => '-7.265757',
          'longitude' => '112.734146',
          'telephone' => '081234567890',
          'email'     => '5345678',
        ] );
    }
}
