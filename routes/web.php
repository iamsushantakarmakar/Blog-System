<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

// Social Authentication
Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.redirect');

Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback');

// Public Post Routes (index only)
Route::get('posts', [PostController::class, 'index'])->name('posts.index');

// Authenticated Routes with Activity Logging
Route::middleware(['auth', 'log.activity'])->group(function () {
    // User Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Post Routes - IMPORTANT: 'create' must come BEFORE '{post}'
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');

    // Post Routes (edit, update, destroy) - require auth + post.owner
    Route::middleware('post.owner')->group(function () {
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    // Comments
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

// Public show route - MUST come AFTER 'posts/create'
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class)->only(['index', 'update', 'destroy']);
    Route::resource('posts', AdminPostController::class)->only(['index', 'destroy']);
    Route::post('posts/{id}/restore', [AdminPostController::class, 'restore'])
        ->name('posts.restore');
});

require __DIR__.'/auth.php';
