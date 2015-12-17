<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';
    protected $fillable = [
    	'first_name',
    	'last_name',
    	'gender',
    	'birth_date',
    	'email',
    	'password',
    	'enabled',
    	'verified',
    	'mobile',
    	'telephone',
    ];
}
