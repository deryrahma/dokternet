<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorExperience extends Model
{
    protected $table = 'doctor_experiences';
    public $timestamps = false;
    protected $fillable = [
    	'doctor_id',
        'name'
    ];



    public function doctor() {
        return $this->belongsTo( 'App\Doctor' );
    }
}
