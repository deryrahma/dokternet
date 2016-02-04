<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Doctor extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'doctor';

    protected $fillable = [
        'user_id',
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
        'activation_code'
    ];


    public function user() {
        return $this->belongsTo( 'App\User' );
    }

    public function city() {
    	return $this->belongsTo( 'App\City' );
    }
    public function specialization()
    {
        return $this->belongsTo('App\Specialization','specialization_id');
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

    public function activateAccount($code)
    {

        $doctor = Doctor::where('activation_code', $code)->first();

        if($doctor)
        {
            $doctor->update(['verified' => 1, 'activation_code' => NULL]);
            Auth::login($doctor);
            return true;
        }
    }
}
