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

//namespace автоматически дописывает к PostController => Blog\PostController
//prefix автоматически дописывает к post => blog/post
Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function() {
    Route::resource('post', 'PostController')->names('blog.post');
});

//php artisan route:list