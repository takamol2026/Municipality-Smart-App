<?php

use App\Http\Controllers\Api\DistrictController;
use Illuminate\Support\Facades\Route;

Route::get('districts', [DistrictController::class, 'index'])->name('api.districts.index');
Route::get('districts/{district}', [DistrictController::class, 'show'])->whereNumber('district')->name('api.districts.show');
