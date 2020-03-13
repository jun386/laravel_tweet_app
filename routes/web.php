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
    return view('top');
});

Auth::routes();

// Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
    Route::get('users/{user}/following', 'FollowersController@following');
    Route::get('users/{user}/followers', 'FollowersController@followers');
    Route::resource('posts', 'PostsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('users/{user}/likes', 'UsersController@likes');
    Route::resource('comments', 'CommentsController', ['only' => ['store', 'destroy']]);
    Route::resource('likes', 'LikesController', ['only' => ['store', 'destroy']]);
});