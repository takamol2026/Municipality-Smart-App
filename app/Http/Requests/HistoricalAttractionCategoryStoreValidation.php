<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoricalAttractionCategoryStoreValidation extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'lang' => ['required', 'in:fa,ps,en,all'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:historical_attraction_categories,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
