<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicPatient extends Model
{
    protected $table = 'clinic_patient';
    protected $fillable = [
    	'patient_id',
    	'clinic_id',
    	'registration_number',
    	'description',
    	'person_in_charge',
    	'person_in_charge_status'
    ];

    public function patient() {
    	return $this->belongsTo( '\App\Users','patient_id','id' );
    }
    public function clinic() {
    	return $this->belongsTo( '\App\Users','clinic_id','id' );
    }
}
