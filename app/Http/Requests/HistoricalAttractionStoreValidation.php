<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoricalAttractionStoreValidation extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'historical_attraction_category_id' => ['required', 'exists:historical_attraction_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'lang' => ['required', 'in:fa,ps,en,all'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:historical_attractions,slug'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'history' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90', 'decimal:0,4'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180', 'decimal:0,4'],
            'image' => ['nullable', 'image'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
