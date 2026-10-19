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
            'lang' => ['required', 'in:fa,ps,en,all'],
            'safaei_category_id' => ['required', 'exists:safaei_category,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'annual_fee' => ['nullable', 'string', 'max:45'],
            'payment_condition' => ['nullable', 'string', 'max:45'],
            'status' => ['required', 'in:active,inactive'],
            'file' => ['required', 'file', 'max:20480'],
        ];
    }
}
