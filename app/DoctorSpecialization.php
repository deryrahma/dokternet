<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    protected $table = 'doctor_specialization';
    protected $fillable = [
    	'doctor_id',
        'specialization_id'
    ];

    public function doctors() {
    	return $this->belongsTo( 'App\Doctor','doctor_id' );
    }
    public function specialization(){
    	return $this->belongsTo('App\Specialization','specialization_id','id');
    }
}
