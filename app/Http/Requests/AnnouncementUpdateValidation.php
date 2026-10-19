<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnnouncementUpdateValidation extends FormRequest
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
            'announcement_category_id' => ['required', 'exists:announcement_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'lang' => ['required', 'in:fa,ps,en,all'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('announcements', 'slug')->ignore($this->route('announcement'))],
            'short_description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'attachment' => ['nullable', 'file', 'max:5120'],
            'publish_date' => ['nullable', 'date'],
            'expire_date' => ['nullable', 'date', 'after_or_equal:publish_date'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
