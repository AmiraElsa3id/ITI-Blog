<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
Route::middleware('auth:sanctum')->group(function () {

    // Posts
    Route::get('/posts',           [PostController::class, 'index']);
    Route::get('/posts/{post}',    [PostController::class, 'show']);
    Route::post('/posts',          [PostController::class, 'store']);
    Route::put('/posts/{post}',    [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

    // Comments
    Route::get('/posts/{post}/comments',    [CommentController::class, 'index']);
    Route::post('/posts/{post}/comments',   [CommentController::class, 'store']);
    Route::delete('/comments/{comment}',    [CommentController::class, 'destroy']);
});