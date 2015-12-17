<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $fillable = [
    	'patient_id',
    	'reservation_id',
    	'doctor_id',
    	'description',
    	'rating',
    ];

    public function doctor() {
    	return $this->belongsTo( 'App\Doctor' );
    }

    public function patient() {
    	return $this->belongsTo( 'App\Patient' );
    }

    public function reservation() {
    	return $this->belongsTo( 'App\Reservation' );
    }
}
