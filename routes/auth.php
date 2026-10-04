<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ScholarController;
use App\Http\Controllers\UrbanServiceCategoryController;
use App\Http\Controllers\UserController;
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

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('districts', [DistrictController::class, 'index'])->name('districts.index');
    Route::get('districts/create', [DistrictController::class, 'create'])->name('districts.create');
    Route::post('districts', [DistrictController::class, 'store'])->name('districts.store');
    Route::get('districts/{district}/image', [DistrictController::class, 'downloadImage'])->name('districts.image');
    Route::get('districts/{district}/files/{file}', [DistrictController::class, 'downloadFile'])->name('districts.files.download');
    Route::delete('districts/{district}/files/{file}', [DistrictController::class, 'destroyFile'])->name('districts.files.destroy');
    Route::get('districts/{district}/edit', [DistrictController::class, 'edit'])->name('districts.edit');
    Route::put('districts/{district}', [DistrictController::class, 'update'])->name('districts.update');
    Route::delete('districts/{district}', [DistrictController::class, 'destroy'])->name('districts.destroy');

    Route::get('urban-service-categories', [UrbanServiceCategoryController::class, 'index'])->name('urban-service-categories.index');
    Route::get('urban-service-categories/create', [UrbanServiceCategoryController::class, 'create'])->name('urban-service-categories.create');
    Route::post('urban-service-categories', [UrbanServiceCategoryController::class, 'store'])->name('urban-service-categories.store');
    Route::get('urban-service-categories/{urbanServiceCategory}/edit', [UrbanServiceCategoryController::class, 'edit'])->name('urban-service-categories.edit');
    Route::put('urban-service-categories/{urbanServiceCategory}', [UrbanServiceCategoryController::class, 'update'])->name('urban-service-categories.update');
    Route::delete('urban-service-categories/{urbanServiceCategory}', [UrbanServiceCategoryController::class, 'destroy'])->name('urban-service-categories.destroy');

    Route::get('scholars', [ScholarController::class, 'index'])->name('scholars.index');
    Route::get('scholars/create', [ScholarController::class, 'create'])->name('scholars.create');
    Route::post('scholars', [ScholarController::class, 'store'])->name('scholars.store');
    Route::get('scholars/{scholar}/image', [ScholarController::class, 'downloadImage'])->name('scholars.image');
    Route::get('scholars/{scholar}/edit', [ScholarController::class, 'edit'])->name('scholars.edit');
    Route::put('scholars/{scholar}', [ScholarController::class, 'update'])->name('scholars.update');
    Route::delete('scholars/{scholar}', [ScholarController::class, 'destroy'])->name('scholars.destroy');
});
