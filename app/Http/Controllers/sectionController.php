<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeSectionRequest;
use App\Section;
use DB;
use Auth;

class sectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return Library Sections 
        $sections = Section::all();

        return view('libraryViewsContainer.library')
                ->withSections($sections);
    }

    /**
     * Display a listing of the resource to Admin.
     */
    public function admin()
    {
        // Return Library Sections with trashed
        $sections = Section::withTrashed()->get();

        return view('libraryViewsContainer.admin')
                ->withSections($sections);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return '<center><h1>Adding New Sectoin to the library</h1></center>';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeSectionRequest $request)
    {
        // storing the new created section to db.

        $section_name = $request->input('section_name');
        $file = $request->file('image');
        $destinationPath = 'images';
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        $new_section = new Section;
        $new_section->section_name = $section_name;
        $new_section->books_total = 0;
        $new_section->image_name = $fileName;
        $new_section->save();

        session()->push('m', 'success');
        session()->push('m', 'Section created successfully!');

        return redirect('admin');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Show Section Page 
        $section = Section::withTrashed()->find($id);

        if ($section->trashed()) {
            
            session()->push('m', 'info');
            session()->push('m', 'Restore the section to show the books!');

            return redirect('admin');

        } else {

            $all_books = $section->books;

            $section->books_total = count($all_books);
            $section->save();

            $all_books = $section->books()->paginate(10);

            $array_of_authors = [];
            $i = 0;

            foreach ($all_books as $book) {
                $array_of_authors = array_add($array_of_authors, $i, 
                    $book->authors()->select('authors.first_name', 'authors.id')->get());
                $i++;
            }

            return view('libraryViewsContainer.books', 
                compact('section', $section, 'all_books', $all_books, 'array_of_authors', $array_of_authors));  
        }
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Edit Section Page
        return '<center><h1>form for '.$id.' section.</h1></center>';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Saving the edited section to the db.
        $section = Section::find($id);
        $section->section_name = $request->section_name;

        $section->save();

        session()->push('m', 'success');
        session()->push('m', 'Section updated successfully!');

        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Delete the sectioin with id = $id from db.
        Section::destroy($id);

        session()->push('m', 'danger');
        session()->push('m', 'Section deleted temporary!');

        return redirect('admin');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        // Restore the sectioin with id = $id from db.
        $section = Section::onlyTrashed()->find($id);
        $section->restore();

        session()->push('m', 'info');
        session()->push('m', 'Section resoted successfully!');

        return redirect('admin');
    }    

    /**
     * Delete Forver the specified resource from storage.
     */
    public function deleteForever($id)
    {
        // Delete Forver the sectioin with id = $id from db.
        $section = Section::onlyTrashed()->find($id);
        $section->forceDelete();

        session()->push('m', 'danger');
        session()->push('m', 'Section deleted successfully!');

        return redirect('admin');
    }

    public function logout()
    {
        // Logout user.
        Auth::logout();

        session()->flush();

        return redirect('library');
    }

}
