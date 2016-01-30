<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    public $timestamps = false;
    protected $fillable = [
    	'province_id',
    	'name',
    ];

    public function province() {
    	return $this->belongsTo( 'App\Province' );
    }

    public function doctors() {
    	return $this->hasMany( 'App\Doctor' );
    }

    public function clinics() {
    	return $this->hasMany( 'App\Clinic' );
    }
}
