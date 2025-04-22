<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Kernel;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/generate-api-key', [AuthController::class, 'generateApiKey']);
    Route::get('/api-key', [AuthController::class, 'showApiKey']);
});
Route::middleware(ApiKeyMiddleware::class)->group(function () {
    Route::get('/movies', [MovieController::class, 'index']);
    Route::post('/movies', [MovieController::class, 'store']);
    Route::get('/movies/{id}', [MovieController::class, 'show']);
    // Route::put('/movies/{id}', [MovieController::class, 'update']);
    Route::put('/movies/{movie}', [MovieController::class, 'update']);
    // Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
});