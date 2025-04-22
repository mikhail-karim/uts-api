<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiKeyController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->get('/apikey', [ApiKeyController::class, 'show'])->name('apikey.show');
Route::middleware(['auth'])->get('/apikey', function () {
    $user = Auth::user();
    return view('apikey', ['apiKey' => $user->api_key]);
})->name('apikey.show');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/movies', function () {
//         return view('movies.index');
//     })->name('movies.index');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/movies', [MovieController::class, 'listView'])->name('movies.index');
//    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::get('/movies/create', function () {
        return view('movies.create');
    })->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::middleware(['auth'])->put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
    Route::middleware(['auth'])->delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});


require __DIR__.'/auth.php';
