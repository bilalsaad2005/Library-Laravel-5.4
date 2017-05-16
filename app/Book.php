<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

	 // Relationship DB Section table and Book table with One to Many.
	 public function section(){
	 	return $this->belongsTo('App\Section');
	 }

	 // Relationship DB Authors table and Book table with Many to Many.
	 public function authors(){
	 	return $this->belongsToMany('App\Author', 'books_authors_relationship');
	 }
}
