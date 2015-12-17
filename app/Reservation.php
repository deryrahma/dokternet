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
    	'disease',
    ];

    public function schedule() {
    	return $this->belongsTo( 'App\Schedule' );
    }

    public function recommendations() {
    	return $this->hasMany( 'App\Recommendation' );
    }

    public function patient() {
    	return $this->belongsTo( 'App\Patient' );
    }

    public function reviews() {
    	return $this->hasMany( 'App\Review' );
    }
}
