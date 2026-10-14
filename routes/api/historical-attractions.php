<?php

use App\Http\Controllers\Api\HistoricalAttractionCategoryController;
use App\Http\Controllers\Api\HistoricalAttractionController;
use Illuminate\Support\Facades\Route;

Route::get('historical-attractions/categories', [HistoricalAttractionCategoryController::class, 'index'])->name('api.historical-attractions.categories.index');
Route::get('historical-attractions/categories/{category}', [HistoricalAttractionCategoryController::class, 'show'])->whereNumber('category')->name('api.historical-attractions.categories.show');
Route::get('historical-attractions', [HistoricalAttractionController::class, 'index'])->name('api.historical-attractions.index');
Route::get('historical-attractions/{attraction}', [HistoricalAttractionController::class, 'show'])->whereNumber('attraction')->name('api.historical-attractions.show');
