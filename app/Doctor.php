<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctor';
    protected $fillable = [
    	'specialization_id',
    	'city_id',
    	'name',
    	'address',
    	'latitude',
    	'longitude',
    	'email',
    	'password',
    	'mobile',
    	'telephone',
    	'verified',
    	'enabled',
    ];

    public function city() {
    	return $this->belongsTo( 'App\City' );
    }

    public function specialization() {
    	return $this->belongsTo( 'App\Specialization' );
    }

    public function reviews() {
    	return $this->hasMany( 'App\Review' );
    }

    public function recommendations() {
    	return $this->hasMany( 'App\Recommendation' );
    }

    public function recommendation_doctors() {
    	return $this->hasMany( 'App\Recommendation', 'recommendation_doctor_id' );
    }

    public function schedules() {
    	return $this->hasMany( 'App\Schedule' );
    }

    public function doctor_clinic() {
    	return $this->hasMany( 'App\DoctorClinic' );
    }
}
