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

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', 'UserController@index');
    Route::get('/users/list', 'UserController@list');
    Route::get('/users/{id}', 'UserController@get');
    Route::post('/users/{id}', 'UserController@update');
    Route::delete('/users/{id}', 'UserController@delete');
    Route::post('/users', 'UserController@create');

    Route::get('/blogs', 'BlogController@index');
});
