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

    public function role()
    {
        return $this->belongsTo('Fresh\Nashemisto\Role');
    }

    public function canDo($action = null)
    {
        switch ($action) {
            case 'UPDATE_CATS':
                if (($this->role->name == 'admin') || ($this->role->name == 'editor')) {
                    return true;
                }
                break;
            case 'UPDATE_CHANNEL':
                if (($this->role->name == 'admin') || ($this->role->name == 'editor')) {
                    return true;
                }
                break;
            case 'UPDATE_PRIORITY':
                if (($this->role->name == 'admin') || ($this->role->name == 'editor')) {
                    return true;
                }
                break;
            default:
                if (($this->role->name == 'admin') || ($this->role->name == 'editor') || ('journalist' === $this->role->name)) {
                    return true;
                }
        }

        return false;

    }
}
