<?php

use App\Http\Controllers\Api\SafaeiCategoryController;
use App\Http\Controllers\Api\SafaeiController;
use Illuminate\Support\Facades\Route;

Route::get('safaei/categories', [SafaeiCategoryController::class, 'index'])->name('api.safaei.categories.index');
Route::get('safaei/categories/{category}', [SafaeiCategoryController::class, 'show'])->whereNumber('category')->name('api.safaei.categories.show');
Route::get('safaei', [SafaeiController::class, 'index'])->name('api.safaei.index');
Route::get('safaei/{file}', [SafaeiController::class, 'show'])->whereNumber('file')->name('api.safaei.show');
