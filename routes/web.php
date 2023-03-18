<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



/**
 * CRUD routes
 *
 */

Route::group(['middleware' => 'auth'], function () {
    // Soft delete
    Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('/posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/force-destroy/{id}', [PostController::class, 'forceDestroy'])->name('posts.force-destroy');

    // Clear cache
    Route::get('clear-cache', [PostController::class, 'clearCache'])->name('clear-cache');

    // Resource controller
    Route::resource('posts', PostController::class);
});

require __DIR__ . '/auth.php';
