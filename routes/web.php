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
    return view('welcome');
});

Auth::routes();
Route::get('/showFavorite', 'PostController@showfavorite')->name('favorite-post');



// Route::get('/home', 'HomeController@index')->name('home');

//route for posts
Route::post('/create/{id}', 'PostController@create')->name('create-post');
Route::get('/home', 'PostController@index')->middleware('auth');
Route::post('/update/{id}', 'PostController@update')->name('update-post');
Route::get('/delete/{id}', 'PostController@delete')->name('delete-post');
Route::get('/post/voted/{post}/{vote}', 'PostController@voted')->name('voted-post');

Route::get('/post/favorite/{id}', 'PostController@favorite')->name('favorite');
Route::get('/post/unfavorite/{id}', 'PostController@unfavorite')->name('unfavorite');
Route::get('/post/isFavorited/{id}', 'PostController@isFavorited')->name('isfavorite');
Route::get('/post/isLike/{id}', 'PostController@isLike')->name('islike');







//route for reply
Route::get('/Reply/{id}', 'ReplyController@index')->name('show-reply');
Route::post('/Reply/{id}/{user}', 'ReplyController@create')->name('write-reply');
Route::get('/Reply/bestAnswer/{id}','ReplyController@bestAnswer')->name('bestAnswer');

Route::patch('/Reply/update/{reply}','ReplyController@update');
Route::get('/Reply/delete/{id}','ReplyController@delete');

Route::get('/reply/voted/{reply}/{vote}', 'ReplyController@voted')->name('voted-reply');





