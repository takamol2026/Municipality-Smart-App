<?php

use App\Http\Controllers\Api\ProjectCategoryController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('projects/categories', [ProjectCategoryController::class, 'index'])->name('api.projects.categories.index');
Route::get('projects/categories/{category}', [ProjectCategoryController::class, 'show'])->whereNumber('category')->name('api.projects.categories.show');
Route::get('projects', [ProjectController::class, 'index'])->name('api.projects.index');
Route::get('projects/{project}', [ProjectController::class, 'show'])->whereNumber('project')->name('api.projects.show');
