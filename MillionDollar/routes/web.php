<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeCommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


// Route::get('/users', function () {
//     return Inertia::render('Users');
// });

Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user/update-image', [UserController::class, 'updateImage'])->name('user.updateImage');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

    Route::post('/like', [LikeController::class, 'store'])->name('like.store');

    Route::post('/search', [PostController::class, 'search'])->name('post.search');

    Route::post('/likeComment', [LikeCommentController::class, 'store'])->name('likecomment.stor');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
