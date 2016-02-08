<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
	public $timestamps = false;
    protected $table = 'province';
    public $timestamps = false;
    protected $fillable = [
    	'name',
    ];

    public function cities() {
    	return $this->hasMany( 'App\City' );
    }
}
