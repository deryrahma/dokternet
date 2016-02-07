<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorEducation extends Model
{
    protected $table = 'doctor_educations';
    public $timestamps = false;
    protected $fillable = [
    	'doctor_id',
        'name',
        'year'
    ];



    public function doctor() {
        return $this->belongsTo( 'App\Doctor' );
    }
}
