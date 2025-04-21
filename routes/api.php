<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);

// Route::get('/', function() {
//     return 'API';
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->post('/generate-api-key', [AuthController::class, 'generateApiKey']);
Route::middleware(['auth:sanctum', ApiKeyMiddleware::class])->group(function () {
    Route::apiResource('movies', MovieController::class);
});