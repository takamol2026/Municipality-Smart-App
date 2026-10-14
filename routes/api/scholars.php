<?php

use App\Http\Controllers\Api\ScholarController;
use Illuminate\Support\Facades\Route;

Route::get('scholars', [ScholarController::class, 'index'])->name('api.scholars.index');
Route::get('scholars/{scholar}', [ScholarController::class, 'show'])->whereNumber('scholar')->name('api.scholars.show');
