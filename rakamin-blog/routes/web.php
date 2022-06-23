<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('homepage');
Route::get('post/{slug}', [App\Http\Controllers\FrontController::class, 'show'])->name('show');
Route::get('category/{category:slug}', [App\Http\Controllers\FrontController::class, 'category'])->name('category');
Route::get('tag/{tag:slug}', [App\Http\Controllers\FrontController::class, 'tag'])->name('tag');

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('tags', App\Http\Controllers\TagController::class);

    // Manage Posts
    Route::get('posts/trash', [App\Http\Controllers\PostController::class , 'trash'])->name('posts.trash');
    Route::post('posts/trash/{id}/restore', [App\Http\Controllers\PostController::class , 'restore'])->name('posts.restore');
    Route::delete('posts/{id}/delete-permanent', [App\Http\Controllers\PostController::class,'deletePermanent'])->name('posts.deletePermanent');
    Route::resource('posts', App\Http\Controllers\PostController::class);
});