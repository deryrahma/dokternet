<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $fillable = [
    	'clinic_id',
    	'doctor_id',
    	'schedule_start',
    	'schedule_end',
    	'date',
    	'quota',
    	'status',
    ];

    public function clinic() {
    	return $this->belongsTo( 'App\Clinic' );
    }

    public function doctor() {
    	return $this->belongsTo( 'App\Doctor' );
    }

    public function reservations() {
    	return $this->hasMany( 'App\Reservation' );
    }
}
