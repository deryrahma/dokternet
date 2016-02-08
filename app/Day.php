<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'days';
    public $timestamps = false;
    protected $fillable = [
    	'name',
    ];

    public function doctors() {
    	return $this->belongsToMany( 'App\Doctor','day_doctor','day_id','doctor_id' );
    }
}
