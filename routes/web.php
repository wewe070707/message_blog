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
    return redirect('/message');
});

Route::get('/home', function () {
    return redirect('/message');
});

Route::auth();

// Route::group(['before'=>'auth'],function(){
Route::get('message','MessageController@index');
Route::post('message','MessageController@store');
Route::get('/message/{message}/edit', 'MessageController@edit');
Route::put('/message/{message}', 'MessageController@update');
Route::delete('/message/{message}', 'MessageController@destroy');
Route::get('message/{message}/notes', 'MessageController@show');

Route::get('profile', 'UserController@show_profile');

Route::post('message/{message}/notes', 'NoteController@store');
Route::post('message/{message}/notes/edit', 'NoteController@edit');
Route::delete('message/{message}/notes/{note}', 'NoteController@destroy');
// });
// Route::get('/messages', 'MessageController@index');
// Route::post('/message', 'MessageController@store');
