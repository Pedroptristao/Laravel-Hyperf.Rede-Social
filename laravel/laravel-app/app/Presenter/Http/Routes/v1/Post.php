<?php

declare(strict_types=1);

use App\Presenter\Http\Post\Create\CreatePostController;
use App\Presenter\Http\Post\Delete\DeletePostController;
use App\Presenter\Http\Post\Index\IndexPostController;
use App\Presenter\Http\Post\Load\LoadPostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/posts')->group(function () {
    Route::get('/', IndexPostController::class)->name('api:v1:posts:index');
    Route::get('/{postId}', LoadPostController::class)->name('api:v1:posts:show');
    Route::post('/', CreatePostController::class)->name('api:v1:posts:store');
    Route::delete('/{postId}', DeletePostController::class)->name('api:v1:posts:delete');
});

