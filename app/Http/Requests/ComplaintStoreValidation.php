<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintStoreValidation extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90', 'decimal:0,4'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180', 'decimal:0,4'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'district_id' => ['nullable', 'exists:districts,id'],
        ];
    }
}
