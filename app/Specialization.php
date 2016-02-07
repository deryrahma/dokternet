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
    	return $this->hasMany('App\Doctor','specialization_id');
    }
    public function specializationCategory(){
    	return $this->belongsTo('App\SpecializationCategory','specialization_category_id','id');
    }
}
