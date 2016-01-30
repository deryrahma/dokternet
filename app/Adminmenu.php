<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Adminmenu extends Model {
    protected $table = 'adminmenus';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = array(
        'name',
        'route',
        'parent_id',
        'order_item',
        'enabled',
    );

    public $_child = null;

    public function parent()
    {
        return $this->belongsTo('\App\Adminmenu', 'parent_id', 'id');
    }

    public function child()
    {
        return $this->hasMany('\App\Adminmenu', 'parent_id', 'id');
    }

    public function listChild()
    {
        return $this->child();
    }

    public function roles()
    {
        return $this->belongsToMany('\App\Role', 'adminmenu_role', 'adminmenu_id', 'role_id');
    }

    public function listRoles()
    {
        return $this->roles();
    }

}
