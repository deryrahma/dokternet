<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Article;
use App\RoleUser;
use App\Role;
use App\Log;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;
    protected $table = 'users';
    protected $guarded = ['id'];
    protected $fillable = [
                        'first_name',
                        'last_name',
                        'gender',
                        'birth_date',
                        'email',
                        'address',
                        'enabled',
                        'verified',
                        'mobile',
                        'telephone',
                        'activation_code',
                        'role_id'
                        ];
    protected $exceptionalRoute = array(
        'user/change_role',
    );
    protected $effectiveMenu = null;
    protected $effectivePermission = null;
    protected $groupRole = null;
    protected $hidden = ['password', 'remember_token'];

    

    public function clinic()
    {
        return $this->hasOne('\App\Clinic', 'user_id', 'id');   
    }

    public function doctor()
    {
        return $this->hasOne('\App\Doctor', 'user_id', 'id');   
    }

    public function patient()
    {
        return $this->hasOne('\App\Patient', 'user_id', 'id');   
    }

    public function roleUsers()
    {
        return $this->hasMany('\App\RoleUser', 'user_id', 'id');
    }
    public function isUser()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }
    public function hasRole($check)
    {
        return in_array($check, array_fetch($this->roles->toArray(),'code'));
    }

    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if($value == $term)
            {
                return $key;
            }
        }
        throw new UnexpectedValueException;
    }
    public function makeUser($t)
    {
        $assign = array();
        $roles = array_fetch(\App\Role::all()->toArray(),'name');
        $assign[] = $this->getIdInArray($roles,$t);
        $this->roles->attach($assign);
    }

    

    public function roles()
    {
        return $this->belongsToMany('\App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function listRole()
    {
        return $this->roles();
    }

    public function hasAccess($route)
    {
        foreach ($this->exceptionalRoute as $exceptionalRoute)
        {
            if ($exceptionalRoute == $route)
            {
                return true;
            }
        }

        $permissions = $this->getEffectivePermission();
        foreach ($permissions as $permission) 
        {
            if ($permission->route == $route)
            {
                return true;
            }
        }
        return false;
    }

    public function getEffectiveMenu()
    {
        if ($this->effectiveMenu != null)
        {
            return $this->effectiveMenu;
        }
        else
        {
            $role = \App\Role::with(array('adminmenu' => function($query){
                $query->orderBy('parent_id')->orderBy('order_item');
            }))->find($this->getRoleId());
            if ($role != null)
            {
                $effectiveMenu = array();
                foreach ($role->adminmenu as $adminmenu) 
                {
                    if ($adminmenu->parent_id == 0)
                    {
                        array_push($effectiveMenu, $adminmenu);
                        $adminmenu->_child = array();
                        foreach ($role->adminmenu as $child) 
                        {
                            if ($child->parent_id == $adminmenu->id)
                            {
                                array_push($adminmenu->_child, $child);

                                $child->_child = array();
                                foreach ($role->adminmenu as $grandChild) 
                                {
                                    if ($grandChild->parent_id == $child->id)
                                    {
                                        array_push($child->_child, $grandChild);
                                    }
                                }
                            }
                        }
                    }
                }
                $this->effectiveMenu = $effectiveMenu;
            }
            else
            {
                $this->effectiveMenu = array();
            }
            return $this->effectiveMenu;
        }
    }

    public function getEffectivePermission()
    {
        if ($this->effectivePermission != null)
        {
            return $this->effectivePermission;
        }
        else
        {
            $role = \App\Role::with('permission')->find($this->getRoleId());
            if ($role != null)
            {
                $this->effectivePermission = $role->permission;
            }
            else
            {
                $this->effectivePermission = array();
            }
            return $this->effectivePermission;
        }
    }

    public function setRoleId($id)
    {
        $role = \App\Role::find($id);
        if ($role != null)
        {
            $this->role_id = $id;
            $this->save();
        }
    }

    public function getRoleId()
    {
        if ($this->role_id == 0)
        {
            if ($this->roles->count() > 0)
            {
                $id = $this->roles->sortByDesc('level')->first()->id;
                $this->setRoleId($id);
                return $this->role_id;
            }
            else
            {
                return 0;
            }            
        }
        else
        {
            return $this->role_id;
        }
    }

    public function getRole()
    {
        if ($this->groupRole != null)
        {
            return $this->groupRole;
        }
        else
        {
            $this->groupRole = \App\Role::find($this->getRoleId());
            return $this->groupRole;
        }
    }    

    public function addRole($role)
    {
        if (!$this->inRole($role))
        {
            $this->roles()->attach($role);
        }
        return true;
    }

    public function removeGroup($role)
    {
        if ($this->inRole($role))
        {
            $this->roles()->detach($role);
        }
        return true;
    }

    public function inRole($role)
    {
        foreach ($this->roles()->get() as $userRole)
        {
            if ($userRole->id == $role->id)
            {
                return true;
            }
        }
        return false;
    }

    public function setRoleByIds($role_ids)
    {
        if (is_array($role_ids))
        {
            $this->roles()->detach();
            foreach ($role_ids as $group_id) {
                $role = \App\Role::find($group_id);
                if ($role != null)
                {
                    $this->addRole($role);
                }
            }
            return true;
        }
        return false;
    }
    public function activateAccount($code)
    {

        $patient = User::where('activation_code', $code)->first();

        if($patient)
        {
            $patient->update(['verified' => 1, 'activation_code' => NULL]);
            Auth::login($patient);
            return true;
        }
    }
}
