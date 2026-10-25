<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenseOnlineServiceStoreValidation extends FormRequest
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
        return $this->serviceRules();
    }

    /**
     * @return array<string, mixed>
     */
    protected function serviceRules(): array
    {
        $imageMax = max(1, (int) config('uploads.image_max_kb'));
        $fileMax = max(1, (int) config('uploads.attachment_max_kb'));
        $fileCount = max(1, (int) config('uploads.attachment_max_count'));

        return [
            'type' => ['required', 'in:license_request,online_form'],
            'name' => ['required', 'string', 'max:255'],
            'lang' => ['required', 'in:fa,ps,en,all'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:'.$imageMax],
            'attachments' => ['nullable', 'array', 'max:'.$fileCount],
            'attachments.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,gif,webp', 'max:'.$fileMax],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
