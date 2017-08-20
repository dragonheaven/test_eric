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

Route::get('/', 'BlogController@publicList');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', 'UserController@index');
    Route::get('/users/list', 'UserController@list');
    Route::post('/users', 'UserController@create');
    Route::get('/users/{id}', 'UserController@get');
    Route::post('/users/{id}', 'UserController@update');
    Route::delete('/users/{id}', 'UserController@delete');

    Route::get('/blogs', 'BlogController@index');
    Route::get('/blogs/list', 'BlogController@list');
    Route::post('/blogs', 'BlogController@create');
    Route::get('/blogs/{id}', 'BlogController@get');
    Route::post('/blogs/{id}', 'BlogController@update');
    Route::delete('/blogs/{id}', 'BlogController@delete');
});

Route::get('/blogs/{slug}/read', 'BlogController@viewBlog');
