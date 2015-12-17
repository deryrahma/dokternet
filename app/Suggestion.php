<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table = 'suggestion';
    protected $fillable = [
    	'email',
    	'title',
    	'description',
    ];
}
