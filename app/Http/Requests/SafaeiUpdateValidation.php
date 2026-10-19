<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SafaeiUpdateValidation extends FormRequest
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
            'safaei_id' => ['required', 'exists:safaei,id'],
            'file' => ['nullable', 'file', 'max:20480'],
        ];
    }
}
