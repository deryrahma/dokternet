<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'specialization';
    protected $fillable = [
    	'name',
    ];

    public function doctors() {
    	return $this->hasMany( 'App\Doctor' );
    }
}
