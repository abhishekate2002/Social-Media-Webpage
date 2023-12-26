<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('auth/register');
});

Route::resource('posts', PostController::class);
Route::resource('blogs', BlogController::class);
Route::get('/blog', function () {
    return view('blog.create');
})->name('blog');

Route::get('blog/{username}', [BlogController::class, 'show'])
    ->name('blogs');

Route::post('/following', [UserController::class, 'search'])
  ->name('following')
  ->middleware('auth');

Route::get('/following',[UserController::class, 'showFollowings'])
  ->name('following')
  ->middleware('auth');

  Route::get('/follow/{id}', [UserController::class, 'followUser'])
  ->name('follow')
  ->middleware('auth');

Route::get('/unfollow/{id}', [UserController::class, 'unfollowUser'])
  ->name('unfollow')
  ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
