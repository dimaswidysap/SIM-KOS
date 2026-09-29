<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController; // 1. Import AuthController


Route::get('/', function () {
    return Inertia::render('home');
})->name('home');

Route::get('/login', function () {
    return Inertia::render('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth'])->group(function () {
    Route::inertia('/dashboard', 'dashboard')->name('dashboard');
});
