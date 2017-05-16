<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Show Author Page
        $author = Author::find($id);
        $all_books = $author->books;

        $array_of_books = [];
        $i = 0;

        foreach ($all_books as $book) {
            $array_of_books = array_add($array_of_books, $i, $book->book_title);
            $i++;
        }

        return view('libraryViewsContainer.authors', 
            compact('author', $author, 'array_of_books', $array_of_books, 'i', $i));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
