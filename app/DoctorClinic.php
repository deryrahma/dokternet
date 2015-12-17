<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorClinic extends Model
{
    protected $table = 'doctor_clinic';
    protected $fillable = [
    	'doctor_id',
    	'clinic_id',
    ];

    public function clinic() {
    	return $this->belongsTo( 'App\Clinic' );
    }

    public function doctor() {
    	return $this->belongsTo( 'App\Doctor' );
    }
}
