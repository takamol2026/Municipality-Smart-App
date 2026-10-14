@php
    $row = $row ?? [];
    $index = $index ?? 0;
@endphp
<div class="border rounded p-3 mb-3 project-media-row">
    <div class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label">{{ __('common.media_title') }}</label>
            <input type="text" name="media[{{ $index }}][title]" class="form-control @error('media.'.$index.'.title') is-invalid @enderror" value="{{ old('media.'.$index.'.title', $row['title'] ?? '') }}" placeholder="{{ __('common.media_title_placeholder') }}">
            @error('media.'.$index.'.title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">{{ __('common.type') }}</label>
            <select name="media[{{ $index }}][type]" class="form-select @error('media.'.$index.'.type') is-invalid @enderror">
                <option value="image" @selected(old('media.'.$index.'.type', $row['type'] ?? 'image') === 'image')>{{ __('common.image') }}</option>
                <option value="video" @selected(old('media.'.$index.'.type', $row['type'] ?? '') === 'video')>{{ __('common.video') }}</option>
                <option value="document" @selected(old('media.'.$index.'.type', $row['type'] ?? '') === 'document')>{{ __('common.document') }}</option>
            </select>
            @error('media.'.$index.'.type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ __('common.file') }}</label>
            <input type="file" name="media[{{ $index }}][file]" class="form-control @error('media.'.$index.'.file') is-invalid @enderror">
            @error('media.'.$index.'.file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-1 text-start">
            <button type="button" class="btn btn-sm btn-light remove-project-media" aria-label="{{ __('common.remove_row') }}">{{ __('common.delete') }}</button>
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ __('common.thumbnail') }}</label>
            <input type="file" name="media[{{ $index }}][thumbnail]" class="form-control @error('media.'.$index.'.thumbnail') is-invalid @enderror" accept="image/*">
            @error('media.'.$index.'.thumbnail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">{{ __('common.sort_order') }}</label>
            <input type="number" name="media[{{ $index }}][sort_order]" class="form-control @error('media.'.$index.'.sort_order') is-invalid @enderror" value="{{ old('media.'.$index.'.sort_order', $row['sort_order'] ?? 0) }}" min="0">
            @error('media.'.$index.'.sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
