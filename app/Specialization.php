<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'specialization';
    protected $fillable = [
    	'name',
        'specialization_category_id'
    ];

    public function doctors() {
    	return $this->belongsToMany( 'App\Doctor','doctor_specialization' );
    }
    public function specializationCategory(){
    	return $this->belongsTo('App\SpecializationCategory','specialization_category_id','id');
    }
}
