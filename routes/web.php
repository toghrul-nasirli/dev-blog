<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::resource('/posts', 'PostController');
Route::get('/', 'PostController@index')->name('index');
Route::get('/own', 'PostController@own')->name('posts.own');

Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');

Route::get('/{slug}', 'PostController@view')->name('slug');

Route::get('/tags/{tag}', 'Admin\TagController@show')->name('tags.show');
Route::get('/categories/{category}', 'Admin\CategoryController@show')->name('categories.show');

Route::post('/comments/{post}', 'CommentController@store')->name('comments.store');
Route::get('/comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
Route::patch('/comments/{comment}', 'CommentController@update')->name('comments.update');
Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

Route::namespace('Admin')->prefix('/admin')->name('admin.')->middleware('can:manage')->group(function () {
    Route::resource('/users', 'UserController', ['except' => ['create', 'store', 'show']]);
    Route::resource('/posts', 'PostController', ['except' => ['create', 'store', 'show']]);
    Route::resource('/categories', 'CategoryController', ['except' => ['show']]);
    Route::resource('/tags', 'TagController', ['except' => ['show']]);
    
    Route::get('/comments', 'CommentController@index')->name('comments.index');
    Route::get('/comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
    Route::patch('/comments/{comment}', 'CommentController@update')->name('comments.update');
    Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');
});
