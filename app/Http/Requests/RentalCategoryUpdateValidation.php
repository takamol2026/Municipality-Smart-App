<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RentalCategoryUpdateValidation extends FormRequest
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
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('rental_categories', 'slug')->ignore($this->route('rentalCategory'))],
            'description' => ['nullable', 'string'],
            'img' => ['nullable', 'image'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
