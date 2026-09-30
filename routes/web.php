<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\SubmitController;

// Halaman umum / publik
Route::get('/', function () {
    return Inertia::render('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::prefix('admin')->group(function () {
        // halaman submit pelanggan
       Route::get('/submit', [SubmitController::class, 'create'])->name('admin.submit');
        //
        Route::inertia('/dashboard', 'dashboard')->name('admin-dashboard');
    });

    Route::prefix('penyewa')->group(function () {
        Route::inertia('/user', 'index')->name('user-dashboard');
    });
});
