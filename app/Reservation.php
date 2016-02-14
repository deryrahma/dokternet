<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';
    protected $fillable = [
    	'patient_id',
    	'schedule_id',
    	'status',
    	'activity',
    	'note',
    	'token',
    	'verified',
        'diagnosis_in',
        'diagnosis_out',
        'laboratory_result',
        'diagnosis_in'
    ];

    public function schedule() {
    	return $this->belongsTo( 'App\Schedule' );
    }

    public function recommendations() {
    	return $this->hasMany( 'App\Recommendation' );
    }

    public function patient() {
    	return $this->belongsTo( 'App\User', 'patient_id' );
    }

    public function reviews() {
    	return $this->hasOne( 'App\Review' );
    }
}
