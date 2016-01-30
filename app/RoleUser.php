<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;

class RoleUser extends Model {

	protected $table = 'role_user';
	protected $guarded = ['id'];
    public $timestamps = false;

    public function role()
    {
    	return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
