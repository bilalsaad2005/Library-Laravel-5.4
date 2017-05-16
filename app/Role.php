<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Relationship DB Users table and Role table with One to Many.
    public function users(){
    	return $this->hasMany('App\User', 'role_id');
    }
}
