<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapLocationStoreValidation extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'media' => $this->filledMediaRows(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'map_category_id' => ['required', 'exists:map_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'lang' => ['required', 'in:fa,ps,en,all'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:map_locations,slug'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'image' => ['nullable', 'image'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'media' => ['nullable', 'array'],
            'media.*.type' => ['nullable', 'in:image,video,document'],
            'media.*.file' => ['required', 'file', 'max:20480'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>|null
     */
    private function filledMediaRows(): ?array
    {
        $rows = [];

        foreach ($this->input('media', []) as $index => $item) {
            if ($this->hasFile("media.$index.file")) {
                $rows[$index] = $item;
            }
        }

        return $rows ?: null;
    }
}
