<?php

use App\Http\Controllers\Admin\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthorPostController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('main');
// })->name('main');
Route::get('/',[HomeController::class,'main'])->name('main');

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

        Route::get('/authors', [AuthorController::class, 'index'])->name('admin.authors');
        Route::get('/authors/create', [AuthorController::class, 'create'])->name('admin.authors.create');
        Route::post('/authors', [AuthorController::class, 'store'])->name('admin.authors.store');
        Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('admin.authors.edit');
        Route::put('admin/authors/{author}/assign-categories', [AuthorController::class, 'assignCategories'])->name('admin.authors.assignCategories');

        Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('admin.authors.update');
        Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');
    });
Route::prefix('author')
    ->middleware('role:author')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('author.dashboard');
        Route::get('/posts', [AuthorPostController::class, 'index'])->name('author.posts');
        Route::get('/posts/create', [AuthorPostController::class, 'create'])->name('author.posts.create');
        Route::post('/posts', [AuthorPostController::class, 'store'])->name('author.posts.store');
        Route::get('/posts/{post}/edit', [AuthorPostController::class, 'edit'])->name('author.posts.edit');
        Route::put('/posts/{post}', [AuthorPostController::class, 'update'])->name('author.posts.update');
        Route::delete('/posts/{post}', [AuthorPostController::class, 'destroy'])->name('author.posts.destroy');
        Route::get('/posts', [AuthorPostController::class, 'index'])->name('author.posts.show');


    });

    Route::get('/latest-news', [PostController::class, 'latestNews'])->name('latest-news');

    // Route::post('/post/{postId}/comment', [PostController::class, 'addComment'])->name('post.comment');
    Route::post('/post/comment/{postId}', [PostController::class, 'addComment'])->name('post.comment');

    // Route::post('/post/{postId}/like', [PostController::class, 'addLike'])->name('post.like');
    Route::post('/post/like/{postId}', [PostController::class, 'addLike'])->name('post.like');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/search', [PostController::class, 'search'])->name('post.search');

    require __DIR__ . '/auth.php';
