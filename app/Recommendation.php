<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $table = 'recommendation';
    protected $fillable = [
    	'doctor_id',
    	'reservation_id',
    	'recommendation_doctor_id',
    ];

    public function doctor() {
    	return $this->belongsTo( 'App\Doctor' );
    }

    public function reservation() {
    	return $this->belongsTo( 'App\Reservation' );
    }

    public function receommended_doctor() {
    	return $this->belongsTo( 'App\Doctor', 'recommendation_doctor_id' );
    }
}
