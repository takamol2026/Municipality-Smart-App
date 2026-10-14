<?php

use App\Http\Controllers\Api\RentalCategoryController;
use App\Http\Controllers\Api\RentalController;
use Illuminate\Support\Facades\Route;

Route::get('rentals/categories', [RentalCategoryController::class, 'index'])->name('api.rentals.categories.index');
Route::get('rentals/categories/{category}', [RentalCategoryController::class, 'show'])->whereNumber('category')->name('api.rentals.categories.show');
Route::get('rentals', [RentalController::class, 'index'])->name('api.rentals.index');
Route::get('rentals/{rental}', [RentalController::class, 'show'])->whereNumber('rental')->name('api.rentals.show');
