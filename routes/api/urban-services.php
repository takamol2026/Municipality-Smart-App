<?php

use App\Http\Controllers\Api\UrbanServiceCategoryController;
use App\Http\Controllers\Api\UrbanServiceController;
use Illuminate\Support\Facades\Route;

Route::get('urban-services/categories', [UrbanServiceCategoryController::class, 'index'])->name('api.urban-services.categories.index');
Route::get('urban-services/categories/{category}', [UrbanServiceCategoryController::class, 'show'])->whereNumber('category')->name('api.urban-services.categories.show');
Route::get('urban-services', [UrbanServiceController::class, 'index'])->name('api.urban-services.index');
Route::get('urban-services/{service}', [UrbanServiceController::class, 'show'])->whereNumber('service')->name('api.urban-services.show');
