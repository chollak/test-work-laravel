<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/posts', 'PostsController@index')->name('posts');
Route::get('/posts/following', 'PostsController@following')->name('posts.following');
Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::get('/posts/liked', 'PostsController@liked')->name('posts.liked');
Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');
Route::get('/posts/{post}/edit', 'PostsController@edit')->name('posts.edit');

Route::put('/posts', 'PostsController@store')->name('posts.store');
Route::post('/posts/{post}', 'PostsController@like')->name('posts.like');
Route::patch('/posts/{post}', 'PostsController@update')->name('posts.update');
Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

Route::get('/account/settings', 'UsersController@settings')->name('account');
Route::get('/user/{user}', 'UsersController@show')->name('account.show');
Route::patch('/account/settings', 'UsersController@update')->name('account.update');
Route::post('/user/{user}', 'UsersController@follow')->name('account.follow');
Route::get('/account', function () {
    return redirect()->route('account.show', ['user' => Auth::id()]);
});