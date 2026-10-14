<?php

use App\Http\Controllers\Api\AnnouncementCategoryController;
use App\Http\Controllers\Api\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::get('announcements/categories', [AnnouncementCategoryController::class, 'index'])->name('api.announcements.categories.index');
Route::get('announcements/categories/{category}', [AnnouncementCategoryController::class, 'show'])->whereNumber('category')->name('api.announcements.categories.show');
Route::get('announcements', [AnnouncementController::class, 'index'])->name('api.announcements.index');
Route::get('announcements/{announcement}', [AnnouncementController::class, 'show'])->whereNumber('announcement')->name('api.announcements.show');
