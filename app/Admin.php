<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $fillable = [
    	'email',
    	'password',
    	'first_name',
    	'last_name',
    ];

    public function hasAccess( $route ) {
    	return true;
    }
}
