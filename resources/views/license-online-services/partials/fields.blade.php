@php
    $service = $service ?? null;
    $imageMax = (int) config('uploads.image_max_kb');
    $fileMax = (int) config('uploads.attachment_max_kb');
    $fileCount = (int) config('uploads.attachment_max_count');
@endphp

<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="row mb-3">
            <div class="col-lg-2">
                <label for="type" class="form-label">{{ __('license_online_services.type') }} <span class="text-danger">*</span></label>
            </div>
            <div class="col-lg-10">
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="">{{ __('license_online_services.type_select') }}</option>
                    @foreach (\App\Enums\LicenseOnlineServiceType::cases() as $type)
                        <option value="{{ $type->value }}" @selected(old('type', $service?->type?->value) === $type->value)>{{ $type->label() }}</option>
                    @endforeach
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-2">
                <label class="form-label">{{ __('common.lang') }} <span class="text-danger">*</span></label>
            </div>
            <div class="col-lg-10">
                @foreach (\App\Enums\Language::cases() as $language)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('lang') is-invalid @enderror" type="radio" name="lang" id="lang_{{ $language->value }}" value="{{ $language->value }}" @checked(old('lang', $service?->lang?->value ?? \App\Enums\Language::All->value) === $language->value)>
                        <label class="form-check-label" for="lang_{{ $language->value }}">{{ $language->label() }}</label>
                    </div>
                @endforeach
                @error('lang')
                    <div class="text-danger small d-block mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-2">
                <label for="name" class="form-label">{{ __('common.name') }} <span class="text-danger">*</span></label>
            </div>
            <div class="col-lg-10">
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $service?->name) }}" placeholder="{{ __('license_online_services.name_placeholder') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-2">
                <label for="description" class="form-label">{{ __('common.description') }}</label>
            </div>
            <div class="col-lg-10">
                <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('license_online_services.description_placeholder') }}">{{ old('description', $service?->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-2">
                <label class="form-label">{{ __('common.status') }} <span class="text-danger">*</span></label>
            </div>
            <div class="col-lg-4">
                <div class="form-check form-check-inline form-radio-success">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', $service?->status?->value ?? 'active') === 'active')>
                    <label class="form-check-label" for="status_active">{{ __('common.active') }}</label>
                </div>
                <div class="form-check form-check-inline form-radio-danger">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status', $service?->status?->value) === 'inactive')>
                    <label class="form-check-label" for="status_inactive">{{ __('common.inactive') }}</label>
                </div>
                @error('status')
                    <div class="text-danger small d-block mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-2">
                <label for="sort_order" class="form-label">{{ __('common.sort_order') }}</label>
            </div>
            <div class="col-lg-4">
                <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $service?->sort_order ?? 0) }}" min="0">
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-2">
                <label for="image" class="form-label">{{ __('common.image') }}</label>
            </div>
            <div class="col-lg-10">
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/gif,image/webp">
                <div class="form-text">{{ __('license_online_services.image_hint', ['size' => $imageMax]) }}</div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($service?->image)
                    <div class="d-flex flex-column align-items-start gap-2 mt-2">
                        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->name }}" class="img-thumbnail" style="max-height: 120px;">
                        <a href="{{ route('license-online-services.image', $service) }}" class="btn btn-sm btn-primary">{{ __('common.download_image') }}</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-2">
                <label for="attachments" class="form-label">{{ __('license_online_services.attachments') }}</label>
            </div>
            <div class="col-lg-10">
                @if ($service?->files?->isNotEmpty())
                    <div class="list-group mb-3">
                        @foreach ($service->files as $file)
                            <div class="list-group-item d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    @if ($file->isImage())
                                        <img src="{{ asset('storage/'.$file->file_path) }}" alt="{{ $file->file_name }}" class="img-thumbnail" style="width: 56px; height: 56px; object-fit: cover;">
                                    @endif
                                    <div>
                                        <div class="fw-medium">{{ $file->file_name }}</div>
                                        <div class="text-muted small">{{ $file->sizeLabel() }}</div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('license-online-services.files.download', [$service, $file]) }}" class="btn btn-sm btn-primary">{{ __('common.download') }}</a>
                                    <button type="submit" form="delete-license-file-{{ $file->id }}" class="btn btn-sm btn-danger" onclick="return confirm(@json(__('license_online_services.delete_file_confirm')))">{{ __('common.delete') }}</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <input type="file" name="attachments[]" id="attachments" class="form-control @error('attachments') is-invalid @enderror @error('attachments.*') is-invalid @enderror" accept=".pdf,.doc,.docx,.xls,.xlsx,image/jpeg,image/png,image/gif,image/webp" multiple>
                <div class="form-text">{{ __('license_online_services.attachments_hint', ['size' => $fileMax, 'count' => $fileCount]) }}</div>
                @error('attachments')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                @error('attachments.*')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-10">
                <div class="text-start">
                    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
                    <a href="{{ route('license-online-services.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>
