<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Price;
use App\RoleUser;
use App\User;

class Role extends Model {

	protected $table = 'roles';
	protected $guarded = ['id'];
    public $timestamps = false;

    public function adminmenu()
    {
        return $this->belongsToMany('App\Adminmenu', 'adminmenu_role', 'role_id', 'adminmenu_id');
    }
    public function permission()
    {
        return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
    }
    public function roleUsers()
    {
    	return $this->hasMany('App\RoleUser', 'role_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user', 'role_id', 'user_id');
    }

}
