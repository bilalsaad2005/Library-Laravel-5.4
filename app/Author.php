<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	// Relationship DB Auther table and Books Table with Many to Many. 
    public function books(){
    	return $this->belongsToMany('App\Book', 'books_authors_relationship');
    }
}
