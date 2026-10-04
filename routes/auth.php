<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScholarController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('scholars', [ScholarController::class, 'index'])->name('scholars.index');
    Route::get('scholars/create', [ScholarController::class, 'create'])->name('scholars.create');
    Route::post('scholars', [ScholarController::class, 'store'])->name('scholars.store');
    Route::get('scholars/{scholar}/image', [ScholarController::class, 'downloadImage'])->name('scholars.image');
    Route::get('scholars/{scholar}/edit', [ScholarController::class, 'edit'])->name('scholars.edit');
    Route::put('scholars/{scholar}', [ScholarController::class, 'update'])->name('scholars.update');
    Route::delete('scholars/{scholar}', [ScholarController::class, 'destroy'])->name('scholars.destroy');
});
