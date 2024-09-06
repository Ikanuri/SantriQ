<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\Home\HomeController::class, 'root']);
    // Route::get('{any}', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('index');

    # logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

require __DIR__ . '/auth.php';
