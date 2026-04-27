<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Posts\SavedPostsController;
use App\Http\Controllers\Posts\likeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [RegisterController::class, 'register'])->name('register');

    Route::post('/register', [RegisterController::class, 'registerStore'])->name('register.store');
    Route::post('/login', [LoginController::class, 'loginStore'])->name('login.store');

});

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LogOutController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        $posts = \App\Models\Post::latest()->get(); // Համոզվիր որ Post-ը մեծատառ է (Model name)
        return view('home', compact('posts'));
    })->name('home');

    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');

    Route::get('/saved', [SavedPostsController::class, 'saved'])->name('saved');
    Route::post('/post/{id}/save', [SavedPostsController::class, 'toggleSave'])->name('post.save');

    Route::get('/liked', [likeController::class, 'like'])->name('like');
    Route::post('/post/{id}/like', [likeController::class, 'toggleLike'])->name('post.like');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::delete('/post/{id}', [AdminController::class, 'deletePost'])->name('admin.delete_post');
    });
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/admin/users/{user}/toggle-block', [AdminController::class, 'toggleBlock'])->name('admin.user.toggle');
    });
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
    });
    Route::middleware(['auth', 'superadmin'])->group(function () {
        Route::get('/admin/settings', [AdminController::class, 'settings']);
    });
    Route::post('/admin/users/{user}/make-admin', [AdminController::class, 'makeAdmin'])
        ->name('admin.users.makeAdmin')
        ->middleware('auth');
    Route::post('/admin/users/{user}/make-user', [AdminController::class, 'makeUser'])
        ->name('admin.users.makeUser')
        ->middleware('auth');

});
