<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrbanServiceStoreValidation extends FormRequest
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
            'urban_service_category_id' => ['required', 'exists:urban_service_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:urban_services,slug'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
