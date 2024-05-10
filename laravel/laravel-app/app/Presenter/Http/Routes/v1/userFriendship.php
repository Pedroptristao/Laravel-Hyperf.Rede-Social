<?php

declare(strict_types=1);

use App\Presenter\Http\UserFriendship\Create\CreateUserFriendshipController;
use App\Presenter\Http\UserFriendship\Index\IndexUserFriendshipController;
use App\Presenter\Http\UserFriendship\Load\LoadUserFriendshipController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/user-friendship')->group(function () {
    Route::get('/', IndexUserFriendshipController::class)->name('api:v1:userfriendship:index');
    Route::post('/', CreateUserFriendshipController::class)->name('api:v1:userfriendship:store');
    Route::get('/{friendshipId}', LoadUserFriendshipController::class)->name('api:v1:userfriendship:show');
});

