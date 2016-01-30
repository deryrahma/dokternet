<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = array(
        'route',
        'enabled',
    );

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'permission_role', 'permission_id', 'role_id');
    }

    public function listRoles()
    {
        return $this->group();
    }

}
