<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SafaeiStoreValidation extends FormRequest
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
            'safaei_category_id' => ['required', 'exists:safaei_category,id'],
            'file' => ['required', 'file', 'max:20480'],
        ];
    }
}
