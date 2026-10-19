<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SafaeiCategoryStoreValidation extends FormRequest
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
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}
