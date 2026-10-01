<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\SubmitController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\RoomController;

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
        Route::get('/pelanggan', [SubmitController::class, 'create'])->name('admin.submit');
        //    fasilitas
        Route::get('/facilities', [FacilityController::class, 'pageFacility'])->name('admin.facility');
        Route::get('/facilities/create', [FacilityController::class, 'pageFormFacility'])->name('admin.form.facility');
        route::post('/facilityStore', [FacilityController::class, 'facilityStore'])->name('facility.store');

        //  kamar
        Route::get('/rooms', [RoomController::class, 'pageRoom'])->name('admin.rooms');


        //
        Route::inertia('/dashboard', 'admin/dashboard')->name('admin-dashboard');
    });

    Route::prefix('penyewa')->group(function () {
        Route::inertia('/user', 'index')->name('user-dashboard');
    });
});
