<?php

namespace Fresh\Nashemisto;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsToMany('Fresh\Nashemisto\Role', 'role_user');
    }

    /**
     * @param null $action
     * @return bool
     */
    public function canDo($action = null)
    {
        switch ($action) {
            case 'UPDATE_CATS':
                if ($this->hasRole('admin') || $this->hasRole('editor')) {
                    return true;
                }
                break;
            case 'UPDATE_CHANNEL':
                if ($this->hasRole('admin') || $this->hasRole('editor')) {
                    return true;
                }
                break;
            case 'UPDATE_ARTICLES':
                if ($this->hasRole('journalist') || $this->hasRole('publicist')) {
                    return true;
                }
                break;
            case 'UPDATE_PRIORITY':
                if ($this->hasRole('admin') || $this->hasRole('editor')) {
                    return true;
                }
                break;
            default:
                if ($this->hasRole('admin')) {
                    return true;
                }
        }

        return false;
    }

    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $name) {
                return true;
            }
        }
        return false;
    }
}
