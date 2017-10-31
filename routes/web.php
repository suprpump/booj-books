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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'BooksController@create');
Route::get('/show', 'BooksController@show');
Route::post('/store', 'BooksController@store');
Route::post('/delete', 'BooksController@delete');
Route::post('/sort', 'BooksController@sort');
Route::post('/edit_order', 'BooksController@order');



//Route::get('/booj-flame', function () {
//    header('Content-Type: image/png');
//    print file_get_contents(storage_path('booj-header.png'));
//});
//
//// Background image
//Route::get('/booj-title', function () {
//    header('Content-Type: image/png');
//    print file_get_contents(storage_path('booj.png'));
//});