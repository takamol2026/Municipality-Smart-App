<?php

namespace App\Http\Controllers;

use App\Support\ThemePreference;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThemePreferenceController extends Controller
{
    public function update(Request $request): JsonResponse
    {
        return response()->json([
            'data' => ThemePreference::store($request),
        ]);
    }

    public function destroy(): JsonResponse
    {
        ThemePreference::forget();

        return response()->json([
            'data' => ThemePreference::all(),
        ]);
    }
}
