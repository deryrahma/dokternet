<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecializationCategory extends Model
{
    protected $table = 'specialization_category';
    protected $fillable = [
    	'name',
    ];

    public function specializationCategory(){
    	return $this->hasMany('App\Specialization','specialization');
    }
}
