<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('comments/{comment}', [CommentController::class, 'apiUpdate'])
    ->name('api.comments.update');

    Route::post('comments', [CommentController::class, 'apiStore'])
    ->name('api.comments.store');

    Route::delete('comments/{id}', [CommentController::class, 'apiDestroy'])
    ->name('api.comments.delete');
});

Route::get('comments/{post}', [CommentController::class, 'apiIndex'])
    ->name('api.comments.index');
