<?php

use App\Http\Controllers\Api\ComplaintController;
use Illuminate\Support\Facades\Route;

Route::post('complaints', [ComplaintController::class, 'store'])->name('api.complaints.store');
