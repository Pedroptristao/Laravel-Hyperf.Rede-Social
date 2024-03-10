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

Route::prefix('posts')->as('posts')->group(function() {
    Route::get('/', \App\Http\Controllers\Api\v1\Posts\IndexController::class)->name('index');
    Route::post('/', \App\Http\Controllers\Api\v1\Posts\StoreController::class)->name('store');
    Route::get('{post:id}', \App\Http\Controllers\Api\v1\Posts\ShowController::class)->name('show');
});
