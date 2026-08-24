<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiPublicController;
use App\Http\Controllers\Api\ApiDashboardController;
use App\Http\Controllers\Api\ApiKarangTarunaController;
use App\Http\Controllers\Api\ApiGaleriController;
use App\Http\Middleware\TrackPageVisit;

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/
Route::middleware([TrackPageVisit::class])->group(function () {
    Route::get('/home', [ApiPublicController::class, 'home']);
    Route::get('/profil', [ApiPublicController::class, 'profil']);
    Route::get('/potensi', [ApiPublicController::class, 'potensi']);
    Route::get('/agenda', [ApiPublicController::class, 'agenda']);
    Route::get('/kontak', [ApiPublicController::class, 'kontak']);
    Route::get('/karang-taruna', [ApiPublicController::class, 'karangTaruna']);
    Route::get('/galeri', [ApiPublicController::class, 'galeri']);
});

/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::post('/login', [ApiAuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Admin API Routes (Laravel Sanctum Bearer Token)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/me', [ApiAuthController::class, 'me']);
    
    // Dashboard Stats API
    Route::get('/dashboard', [ApiDashboardController::class, 'index']);

    // Karang Taruna CRUD API
    Route::get('/karang-taruna', [ApiKarangTarunaController::class, 'index']);
    Route::post('/karang-taruna', [ApiKarangTarunaController::class, 'store']);
    Route::get('/karang-taruna/{id}', [ApiKarangTarunaController::class, 'show']);
    Route::post('/karang-taruna/{id}', [ApiKarangTarunaController::class, 'update']);
    Route::delete('/karang-taruna/{id}', [ApiKarangTarunaController::class, 'destroy']);

    // Galeri CRUD API
    Route::get('/galeri', [ApiGaleriController::class, 'index']);
    Route::post('/galeri', [ApiGaleriController::class, 'store']);
    Route::get('/galeri/{id}', [ApiGaleriController::class, 'show']);
    Route::post('/galeri/{id}', [ApiGaleriController::class, 'update']);
    Route::delete('/galeri/{id}', [ApiGaleriController::class, 'destroy']);
});
