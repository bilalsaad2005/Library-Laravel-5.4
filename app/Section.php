<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    // 
	 use SoftDeletes;

	 protected $dates = ['deleted_at'];

	 // Relationship DB Section table and Books table with One to Many.
	 public function Books(){
	 	return $this->hasMany('App\Book');
	 }

}
