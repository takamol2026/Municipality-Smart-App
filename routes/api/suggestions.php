<?php

use App\Http\Controllers\Api\SuggestionController;
use Illuminate\Support\Facades\Route;

Route::post('suggestions', [SuggestionController::class, 'store'])->name('api.suggestions.store');
