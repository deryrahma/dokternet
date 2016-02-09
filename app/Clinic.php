<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $table = 'clinic';
    protected $fillable = [
    	'user_id',
        'city_id',
    	'name',
    	'address',
    	'latitude',
    	'longitude',
    	'telephone',
    	'email',
    	'password',
    ];



    public function user() {
        return $this->belongsTo( 'App\User' );
    }

    public function city() {
    	return $this->belongsTo( 'App\City' );
    }

    public function doctor_clinic() {
    	return $this->hasMany( 'App\DoctorClinic' );
    }
    public function doctors(){
        return $this->belongsToMany('App\Doctor','doctor_clinic','clinic_id','doctor_id');
    }
}
