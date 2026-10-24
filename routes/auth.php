<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\AnnouncementCategoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HistoricalAttractionCategoryController;
use App\Http\Controllers\HistoricalAttractionController;
use App\Http\Controllers\MapCategoryController;
use App\Http\Controllers\MapLocationController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RentalCategoryController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SafaeiCategoryController;
use App\Http\Controllers\SafaeiController;
use App\Http\Controllers\ScholarController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UrbanServiceCategoryController;
use App\Http\Controllers\UrbanServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');

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

    Route::get('urban-services', [UrbanServiceController::class, 'index'])->name('urban-services.index');
    Route::get('urban-services/create', [UrbanServiceController::class, 'create'])->name('urban-services.create');
    Route::post('urban-services', [UrbanServiceController::class, 'store'])->name('urban-services.store');
    Route::get('urban-services/{urbanService}/edit', [UrbanServiceController::class, 'edit'])->name('urban-services.edit');
    Route::put('urban-services/{urbanService}', [UrbanServiceController::class, 'update'])->name('urban-services.update');
    Route::delete('urban-services/{urbanService}', [UrbanServiceController::class, 'destroy'])->name('urban-services.destroy');

    Route::get('historical-attraction-categories', [HistoricalAttractionCategoryController::class, 'index'])->name('historical-attraction-categories.index');
    Route::get('historical-attraction-categories/create', [HistoricalAttractionCategoryController::class, 'create'])->name('historical-attraction-categories.create');
    Route::post('historical-attraction-categories', [HistoricalAttractionCategoryController::class, 'store'])->name('historical-attraction-categories.store');
    Route::get('historical-attraction-categories/{historicalAttractionCategory}/image', [HistoricalAttractionCategoryController::class, 'downloadImage'])->name('historical-attraction-categories.image');
    Route::get('historical-attraction-categories/{historicalAttractionCategory}/edit', [HistoricalAttractionCategoryController::class, 'edit'])->name('historical-attraction-categories.edit');
    Route::put('historical-attraction-categories/{historicalAttractionCategory}', [HistoricalAttractionCategoryController::class, 'update'])->name('historical-attraction-categories.update');
    Route::delete('historical-attraction-categories/{historicalAttractionCategory}', [HistoricalAttractionCategoryController::class, 'destroy'])->name('historical-attraction-categories.destroy');

    Route::get('historical-attractions', [HistoricalAttractionController::class, 'index'])->name('historical-attractions.index');
    Route::get('historical-attractions/create', [HistoricalAttractionController::class, 'create'])->name('historical-attractions.create');
    Route::post('historical-attractions', [HistoricalAttractionController::class, 'store'])->name('historical-attractions.store');
    Route::get('historical-attractions/{historicalAttraction}/image', [HistoricalAttractionController::class, 'downloadImage'])->name('historical-attractions.image');
    Route::get('historical-attractions/{historicalAttraction}/edit', [HistoricalAttractionController::class, 'edit'])->name('historical-attractions.edit');
    Route::put('historical-attractions/{historicalAttraction}', [HistoricalAttractionController::class, 'update'])->name('historical-attractions.update');
    Route::delete('historical-attractions/{historicalAttraction}', [HistoricalAttractionController::class, 'destroy'])->name('historical-attractions.destroy');

    Route::get('announcement-categories', [AnnouncementCategoryController::class, 'index'])->name('announcement-categories.index');
    Route::get('announcement-categories/create', [AnnouncementCategoryController::class, 'create'])->name('announcement-categories.create');
    Route::post('announcement-categories', [AnnouncementCategoryController::class, 'store'])->name('announcement-categories.store');
    Route::get('announcement-categories/{announcementCategory}/edit', [AnnouncementCategoryController::class, 'edit'])->name('announcement-categories.edit');
    Route::put('announcement-categories/{announcementCategory}', [AnnouncementCategoryController::class, 'update'])->name('announcement-categories.update');
    Route::delete('announcement-categories/{announcementCategory}', [AnnouncementCategoryController::class, 'destroy'])->name('announcement-categories.destroy');

    Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('announcements/{announcement}/image', [AnnouncementController::class, 'downloadImage'])->name('announcements.image');
    Route::get('announcements/{announcement}/attachment', [AnnouncementController::class, 'downloadAttachment'])->name('announcements.attachment');
    Route::get('announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

    Route::get('project-categories', [ProjectCategoryController::class, 'index'])->name('project-categories.index');
    Route::get('project-categories/create', [ProjectCategoryController::class, 'create'])->name('project-categories.create');
    Route::post('project-categories', [ProjectCategoryController::class, 'store'])->name('project-categories.store');
    Route::get('project-categories/{projectCategory}/image', [ProjectCategoryController::class, 'downloadImage'])->name('project-categories.image');
    Route::get('project-categories/{projectCategory}/edit', [ProjectCategoryController::class, 'edit'])->name('project-categories.edit');
    Route::put('project-categories/{projectCategory}', [ProjectCategoryController::class, 'update'])->name('project-categories.update');
    Route::delete('project-categories/{projectCategory}', [ProjectCategoryController::class, 'destroy'])->name('project-categories.destroy');

    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{project}/image', [ProjectController::class, 'downloadImage'])->name('projects.image');
    Route::get('projects/{project}/media/{projectMedia}', [ProjectController::class, 'downloadMedia'])->name('projects.media.download');
    Route::delete('projects/{project}/media/{projectMedia}', [ProjectController::class, 'destroyMedia'])->name('projects.media.destroy');
    Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('map-categories', [MapCategoryController::class, 'index'])->name('map-categories.index');
    Route::get('map-categories/create', [MapCategoryController::class, 'create'])->name('map-categories.create');
    Route::post('map-categories', [MapCategoryController::class, 'store'])->name('map-categories.store');
    Route::get('map-categories/{mapCategory}/image', [MapCategoryController::class, 'downloadImage'])->name('map-categories.image');
    Route::get('map-categories/{mapCategory}/edit', [MapCategoryController::class, 'edit'])->name('map-categories.edit');
    Route::put('map-categories/{mapCategory}', [MapCategoryController::class, 'update'])->name('map-categories.update');
    Route::delete('map-categories/{mapCategory}', [MapCategoryController::class, 'destroy'])->name('map-categories.destroy');

    Route::get('map-locations', [MapLocationController::class, 'index'])->name('map-locations.index');
    Route::get('map-locations/create', [MapLocationController::class, 'create'])->name('map-locations.create');
    Route::post('map-locations', [MapLocationController::class, 'store'])->name('map-locations.store');
    Route::get('map-locations/{mapLocation}/image', [MapLocationController::class, 'downloadImage'])->name('map-locations.image');
    Route::get('map-locations/{mapLocation}/media/{mapMedia}', [MapLocationController::class, 'downloadMedia'])->name('map-locations.media.download');
    Route::delete('map-locations/{mapLocation}/media/{mapMedia}', [MapLocationController::class, 'destroyMedia'])->name('map-locations.media.destroy');
    Route::get('map-locations/{mapLocation}/edit', [MapLocationController::class, 'edit'])->name('map-locations.edit');
    Route::put('map-locations/{mapLocation}', [MapLocationController::class, 'update'])->name('map-locations.update');
    Route::delete('map-locations/{mapLocation}', [MapLocationController::class, 'destroy'])->name('map-locations.destroy');

    Route::get('rental-categories', [RentalCategoryController::class, 'index'])->name('rental-categories.index');
    Route::get('rental-categories/create', [RentalCategoryController::class, 'create'])->name('rental-categories.create');
    Route::post('rental-categories', [RentalCategoryController::class, 'store'])->name('rental-categories.store');
    Route::get('rental-categories/{rentalCategory}/image', [RentalCategoryController::class, 'downloadImage'])->name('rental-categories.image');
    Route::get('rental-categories/{rentalCategory}/edit', [RentalCategoryController::class, 'edit'])->name('rental-categories.edit');
    Route::put('rental-categories/{rentalCategory}', [RentalCategoryController::class, 'update'])->name('rental-categories.update');
    Route::delete('rental-categories/{rentalCategory}', [RentalCategoryController::class, 'destroy'])->name('rental-categories.destroy');

    Route::get('rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('rentals/create', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('rentals/{rental}/image', [RentalController::class, 'downloadImage'])->name('rentals.image');
    Route::get('rentals/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
    Route::put('rentals/{rental}', [RentalController::class, 'update'])->name('rentals.update');
    Route::delete('rentals/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy');

    Route::get('safaei-categories', [SafaeiCategoryController::class, 'index'])->name('safaei-categories.index');
    Route::get('safaei-categories/create', [SafaeiCategoryController::class, 'create'])->name('safaei-categories.create');
    Route::post('safaei-categories', [SafaeiCategoryController::class, 'store'])->name('safaei-categories.store');
    Route::get('safaei-categories/{safaeiCategory}/edit', [SafaeiCategoryController::class, 'edit'])->name('safaei-categories.edit');
    Route::put('safaei-categories/{safaeiCategory}', [SafaeiCategoryController::class, 'update'])->name('safaei-categories.update');
    Route::delete('safaei-categories/{safaeiCategory}', [SafaeiCategoryController::class, 'destroy'])->name('safaei-categories.destroy');

    Route::get('safaei', [SafaeiController::class, 'index'])->name('safaei.index');
    Route::get('safaei/create', [SafaeiController::class, 'create'])->name('safaei.create');
    Route::post('safaei', [SafaeiController::class, 'store'])->name('safaei.store');
    Route::get('safaei/{safaei}/download', [SafaeiController::class, 'download'])->name('safaei.download');
    Route::get('safaei/{safaei}/edit', [SafaeiController::class, 'edit'])->name('safaei.edit');
    Route::put('safaei/{safaei}', [SafaeiController::class, 'update'])->name('safaei.update');
    Route::delete('safaei/{safaei}', [SafaeiController::class, 'destroy'])->name('safaei.destroy');

    Route::get('complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::put('complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');

    Route::get('suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
    Route::put('suggestions/{suggestion}', [SuggestionController::class, 'update'])->name('suggestions.update');

    Route::get('scholars', [ScholarController::class, 'index'])->name('scholars.index');
    Route::get('scholars/create', [ScholarController::class, 'create'])->name('scholars.create');
    Route::post('scholars', [ScholarController::class, 'store'])->name('scholars.store');
    Route::get('scholars/{scholar}/image', [ScholarController::class, 'downloadImage'])->name('scholars.image');
    Route::get('scholars/{scholar}/edit', [ScholarController::class, 'edit'])->name('scholars.edit');
    Route::put('scholars/{scholar}', [ScholarController::class, 'update'])->name('scholars.update');
    Route::delete('scholars/{scholar}', [ScholarController::class, 'destroy'])->name('scholars.destroy');
});
