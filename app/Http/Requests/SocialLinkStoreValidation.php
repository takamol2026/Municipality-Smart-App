<?php

namespace App\Http\Requests;

use App\Enums\SocialNetwork;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SocialLinkStoreValidation extends FormRequest
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
            'network' => ['required', Rule::enum(SocialNetwork::class)],
            'url' => ['required', 'url', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
