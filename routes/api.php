<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryViewController;

// Public auth endpoints
Route::post('/auth/login', [AuthApiController::class, 'login']);
Route::post('/auth/register', [AuthApiController::class, 'register']); // controller guards admin-only except first admin

// Protected API endpoints (require Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthApiController::class, 'logout']);
    Route::get('/auth/profile', [AuthApiController::class, 'profile']);

        // Gallery CRUD and interactions
    Route::post('/galleries', [GalleryController::class, 'store']);
    Route::put('/galleries/{id}', [GalleryController::class, 'apiUpdate'])->whereNumber('id');
    Route::delete('/galleries/{id}', [GalleryController::class, 'apiDestroy'])->whereNumber('id');
    
    // Gallery view and details
    Route::get('/galleries/{gallery}', [GalleryViewController::class, 'show']);
    Route::post('/galleries/{gallery}/view', [GalleryViewController::class, 'incrementViews']);
    
    // Likes and Dislikes
    Route::post('/galleries/{gallery}/like', [LikeController::class, 'store']);
    Route::delete('/galleries/{gallery}/like', [LikeController::class, 'destroy']);
    Route::post('/galleries/{gallery}/dislike', [DislikeController::class, 'store']);
    Route::delete('/galleries/{gallery}/dislike', [DislikeController::class, 'destroy']);
    
    // Comments
    Route::get('/galleries/{gallery}/comments', [CommentController::class, 'index']);
    Route::post('/galleries/{gallery}/comments', [CommentController::class, 'storeApi']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});

// Public read-only endpoints
Route::get('/galleries', [GalleryController::class, 'apiIndex']);
Route::get('/galleries/search', [GalleryController::class, 'apiSearch']);
Route::get('/galleries/{id}', [GalleryController::class, 'apiShow'])->whereNumber('id');

