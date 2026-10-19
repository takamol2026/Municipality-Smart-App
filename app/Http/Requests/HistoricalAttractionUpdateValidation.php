<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HistoricalAttractionUpdateValidation extends FormRequest
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
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('historical_attractions', 'slug')->ignore($this->route('historicalAttraction'))],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'history' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
