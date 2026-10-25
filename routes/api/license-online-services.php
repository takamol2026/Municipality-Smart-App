<?php

use App\Http\Controllers\Api\LicenseOnlineServiceController;
use Illuminate\Support\Facades\Route;

Route::get('license-online-services', [LicenseOnlineServiceController::class, 'index'])->name('api.license-online-services.index');
Route::get('license-online-services/{licenseOnlineService}', [LicenseOnlineServiceController::class, 'show'])->whereNumber('licenseOnlineService')->name('api.license-online-services.show');
