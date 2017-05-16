<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationship DB User table and Roles table with One to Many.
    public function roles(){
        return $this->belongsTo('App\Role', 'role_id');
    }

    // Checking if User has Role SuperAdmin, Admin or Editor.
    public function hasRole($title){
        $user_role = $this->roles;
        if(!is_null($user_role)){
            $user_role = $user_role->role_name;
        }
        return ($user_role === $title)?true:false;
    }
}
