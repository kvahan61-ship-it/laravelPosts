<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;


Route::get('/login', [Controller::class, 'login'])->name('login');
Route::get('/register', [Controller::class, 'register'])->name('register');

Route::post('/register', [Controller::class, 'registerStore'])->name('register.store');
Route::post('/login', [Controller::class, 'loginStore'])->name('login.store');

Route::post('/logout', [Controller::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('post.index');
    Route::get('/posts/create', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::post('/posts', 'App\Http\Controllers\PostController@store')->name('post.store');
    Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show')->name('post.show');
    Route::get('/posts/{post}/edit', 'App\Http\Controllers\PostController@edit')->name('post.edit');
    Route::patch('/posts/{post}', 'App\Http\Controllers\PostController@update')->name('post.update');
    Route::    delete('/posts/{post}', 'App\Http\Controllers\PostController@destroy')->name('post.delete');


    Route::middleware('auth')->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    });

    Route::get('/', function () {
        $posts = \App\Models\post::latest()->get();
        return view('home', compact('posts'));
    })->name('home');

    Route::get('/saved', [\App\Http\Controllers\SavedPostsController::class, 'saved'])
        ->name('saved')
        ->middleware('auth');
    Route::post('/post/{id}/save', [\App\Http\Controllers\SavedPostsController::class, 'toggleSave'])
        ->name('post.save')
        ->middleware('auth');

    Route::get('/liked', [\App\Http\Controllers\likeController::class, 'like'])
        ->name('like')
        ->middleware('auth');
    Route::post('/post/{id}/like', [\App\Http\Controllers\likeController::class, 'toggleLike'])
        ->name('post.like')
        ->middleware('auth');

});
