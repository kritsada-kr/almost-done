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
    return redirect()->route('posts.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::post('/posts/{post}/comments/store', [\App\Http\Controllers\PostController::class, 'storeComment'])
    ->name('posts.comments.store');

Route::post('/posts/{post}/statusTrackers/store', [\App\Http\Controllers\PostController::class, 'storeStatus'])
    ->name('posts.statusTrackers.store');

Route::post('/posts/{post}/images/deleteAll', [\App\Http\Controllers\PostController::class, 'deleteAllImages'])
    ->name('posts.images.deleteAll');

Route::post('/posts/{post}/images/deleteImage', [\App\Http\Controllers\PostController::class,'deleteImage'])
    ->name('posts.images.deleteImage');

Route::post('/posts/{post}/likes/like',[\App\Http\Controllers\PostController::class,'like'])
    ->name('posts.likes.like');

Route::resource('/users',\App\Http\Controllers\UserController::class);

Route::resource('/popularposts',\App\Http\Controllers\PopularPostController::class);

Route::resource('/posts', \App\Http\Controllers\PostController::class);

Route::resource('/tags', \App\Http\Controllers\TagController::class);

Route::resource('/organizationTags', \App\Http\Controllers\OrganizationTagController::class);

Route::resource('/charts', \App\Http\Controllers\ChartController::class);

Route::get('/search',[\App\Http\Controllers\PostController::class ,'search']);

Route::get('/sortByView',[\App\Http\Controllers\PostController::class,'sortByView']);
