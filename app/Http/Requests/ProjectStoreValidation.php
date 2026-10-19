<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreValidation extends FormRequest
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
            'project_category_id' => ['required', 'exists:project_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'image' => ['nullable', 'image'],
            'status' => ['required', 'in:active,inactive'],
            'status_publish' => ['required', 'in:in_progress,completed,not_started'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'media' => ['nullable', 'array'],
            'media.*.title' => ['nullable', 'string', 'max:255'],
            'media.*.type' => ['nullable', 'in:image,video,document'],
            'media.*.file' => ['required', 'file', 'max:20480'],
            'media.*.thumbnail' => ['nullable', 'image'],
            'media.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>|null
     */
    private function filledMediaRows(): ?array
    {
        $rows = [];

        foreach ($this->input('media', []) as $index => $item) {
            $hasFile = $this->hasFile("media.$index.file") || $this->hasFile("media.$index.thumbnail");
            $hasText = filled($item['title'] ?? null);

            if ($hasFile || $hasText) {
                $rows[$index] = $item;
            }
        }

        return $rows ?: null;
    }
}
