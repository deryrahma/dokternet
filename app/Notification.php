<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    protected $fillable = [
    	'patient_id',
    	'user_flag',
    	'title',
    	'description',
    ];

    public function patient() {
    	return $this->belongsTo( 'App\Patient' );
    }
}
