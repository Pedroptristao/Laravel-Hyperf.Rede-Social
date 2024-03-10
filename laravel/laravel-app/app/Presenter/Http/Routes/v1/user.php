<?php

declare(strict_types=1);

use App\Presenter\Http\User\Create\CreateUserController;
use App\Presenter\Http\User\Index\IndexUserController;
use App\Presenter\Http\User\Load\LoadUserController;
use App\Presenter\Http\User\Login\LoginUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/user')->group(function () {
    Route::post('/', CreateUserController::class)->name('api:v1:user:store');
    Route::get('/', IndexUserController::class)->name('api:v1:user:index');
    Route::get('/{userId}', LoadUserController::class)->name('api:v1:user:show');
});

Route::post('/user/login', LoginUserController::class);
