<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalStoreValidation extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'rental_price' => $this->filled('rental_price') ? $this->input('rental_price') : null,
            'rental_period' => $this->filled('rental_period') ? $this->input('rental_period') : null,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'rental_category_id' => ['required', 'exists:rental_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'lang' => ['required', 'in:fa,ps,en,all'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:rentals,slug'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'rental_price' => ['nullable', 'integer', 'min:0'],
            'rental_period' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
