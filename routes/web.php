<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.home.index');
});

Route::prefix('genres')->name('genres.')->group(function () {
    Route::get('/', [GenreController::class, 'index'])->name('index');
    Route::get('/create', [GenreController::class, 'create'])->name('create');
    Route::post('/', [GenreController::class, 'store'])->name('store');
    Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('edit');
    Route::put('/{genre}', [GenreController::class, 'update'])->name('update');
    Route::delete('/{genre}', [GenreController::class, 'destroy'])->name('destroy');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});
