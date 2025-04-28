<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('admin')
    ->middleware('role:admin')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });
Route::prefix('author')
    ->middleware('role:author')
    ->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('author.dashboard');
    Route::get('/posts', [PostController::class, 'index'])->name('author.posts');
    Route::get('/posts/create', [PostController::class, 'create'])->name('author.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('author.posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('author.posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('author.posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('author.posts.destroy');
});


require __DIR__ . '/auth.php';
