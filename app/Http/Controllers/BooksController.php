<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeBookRequest;
use App\Book;
use App\Author;
use DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Create Summary for library.
        $results = Book::with('section', 'authors')->paginate(10);
        return view('summary', compact('results', $results));
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
    public function store(storeBookRequest $request)
    {
        //
        DB::transaction(function($request) use($request) {

            $author_id = 1;
            $another_author = $request->another_author;
            $author2 = Author::where('first_name', $another_author)
                        ->select('id')
                        ->first();


            $book_title = $request->book_title;
            $book_edition = $request->book_edition;
            $book_description = $request->book_description;
            $book_publication = $request->book_publication;
            $section_id = $request->section_id;
            $ID_Book = Book::insertGetId(['book_title'=>$book_title,
                                  'book_edition'=>$book_edition,
                                  'book_description'=>$book_description,
                                  'book_publication'=>$book_publication,
                                  'section_id'=>$section_id]);

            if ($author2 != null) {
                $author2_id = $author2->id;
                DB::table('books_authors_relationship')
                    ->insert([
                        ['book_id'=> $ID_Book, 'author_id' => $author_id],
                        ['book_id' => $ID_Book, 'author_id' => $author2_id] 
                        ]);
            } else {
                DB::table('books_authors_relationship')
                    ->insert(['book_id'=> $ID_Book, 'author_id' => $author_id]);
            }
        }); // End of transaction function

        $section_id = $request->section_id;    
        return redirect('library/'.$section_id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
      return book::where('id', '=', $id)->get();
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
        $book_title = $request->book_title;
        $book_edition = $request->book_edition;
        $book_description = $request->book_description;
        $book_publication = $request->book_publication;
        $section_id = $request->section_id;

        Book::where('id', $id)
                ->update(['book_title'=>$book_title,
                          'book_edition'=>$book_edition,
                          'book_description'=>$book_description,
                          'book_publication'=>$book_publication]);

        session()->push('m', 'success');
        session()->push('m', 'The Book updated successfully!');

        return redirect('library/'.$section_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {

        $section_id = $request->section_id;
        Book::destroy($id);

        session()->push('m', 'danger');
        session()->push('m', 'The Book deleted successfully!');

        return redirect('library/'.$section_id);
    }

}
