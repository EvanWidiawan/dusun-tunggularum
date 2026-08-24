<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KarangTarunaController as AdminKarangTarunaController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Middleware\TrackPageVisit;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::middleware([TrackPageVisit::class])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/profil', [PageController::class, 'profil'])->name('profil');
    Route::get('/potensi', [PageController::class, 'potensi'])->name('potensi');
    Route::get('/agenda', [PageController::class, 'agenda'])->name('agenda');
    Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
    Route::get('/karang-taruna', [PageController::class, 'karangTaruna'])->name('karang-taruna');
    Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Karang Taruna
    Route::get('/karang-taruna', [AdminKarangTarunaController::class, 'index'])->name('karang-taruna.index');
    Route::post('/karang-taruna', [AdminKarangTarunaController::class, 'store'])->name('karang-taruna.store');
    Route::post('/karang-taruna/{karangTaruna}', [AdminKarangTarunaController::class, 'update'])->name('karang-taruna.update');
    Route::delete('/karang-taruna/{karangTaruna}', [AdminKarangTarunaController::class, 'destroy'])->name('karang-taruna.destroy');

    // CRUD Galeri
    Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('galeri.index');
    Route::post('/galeri', [AdminGaleriController::class, 'store'])->name('galeri.store');
    Route::post('/galeri/{galeri}', [AdminGaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{galeri}', [AdminGaleriController::class, 'destroy'])->name('galeri.destroy');
});
