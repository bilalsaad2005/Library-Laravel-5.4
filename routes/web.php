<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'sectionController@index');

Route::get('admin', 'sectionController@admin');
Route::get('summary', 'booksController@index');
Route::get('logout', 'sectionController@logout');
Route::post('store', 'sectionController@store');
Route::get('library', 'sectionController@index');

Route::resource('books', 'booksController');
Route::resource('authors', 'authorsController');

Route::post('library/store', ['middleware'=>'create:SuperAdmin,Admin','uses'=>'sectionController@store']);
Route::get('library/{id}', ['uses'=>'sectionController@show']);
Route::patch('library/{id}', ['middleware'=>'update:SuperAdmin,Editor','uses'=>'sectionController@update']);
Route::delete('library/{id}', ['middleware'=>'delete:SuperAdmin','uses'=>'sectionController@destroy']);
Route::post('library/restore/{id}', ['uses'=>'sectionController@restore']);
Route::post('library/delete-forever/{id}', ['uses'=>'sectionController@deleteForever']);

Auth::routes();

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

