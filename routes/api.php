<?php
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    // This automatically prefixes all route names with 'api.'
    Route::apiResource('posts', PostController::class);

    Route::get('posts/{post}/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
