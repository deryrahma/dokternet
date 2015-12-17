<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';
    protected $fillable = [
    	'name',
    ];

    public function cities() {
    	return $this->hasMany( 'App\City' );
    }
}
