<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/admin/register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('admin/register', [RegisteredUserController::class, 'store']);

    Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('/admin/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
