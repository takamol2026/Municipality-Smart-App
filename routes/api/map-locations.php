<?php

use App\Http\Controllers\Api\MapCategoryController;
use App\Http\Controllers\Api\MapLocationController;
use Illuminate\Support\Facades\Route;

Route::get('map-locations/categories', [MapCategoryController::class, 'index'])->name('api.map-locations.categories.index');
Route::get('map-locations/categories/{category}', [MapCategoryController::class, 'show'])->whereNumber('category')->name('api.map-locations.categories.show');
Route::get('map-locations', [MapLocationController::class, 'index'])->name('api.map-locations.index');
Route::get('map-locations/{location}', [MapLocationController::class, 'show'])->whereNumber('location')->name('api.map-locations.show');
