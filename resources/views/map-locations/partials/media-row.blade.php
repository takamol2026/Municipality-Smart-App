@php
    $row = $row ?? [];
    $index = $index ?? 0;
@endphp
<div class="border rounded p-3 mb-3 map-media-row">
    <div class="row g-2 align-items-end">
        <div class="col-md-4">
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
        <div class="col-md-6">
            <label class="form-label">{{ __('common.file') }}</label>
            <input type="file" name="media[{{ $index }}][file]" class="form-control @error('media.'.$index.'.file') is-invalid @enderror">
            @error('media.'.$index.'.file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-2 text-start">
            <button type="button" class="btn btn-sm btn-light remove-map-media" aria-label="{{ __('common.remove_row') }}">{{ __('common.delete') }}</button>
        </div>
    </div>
</div>
