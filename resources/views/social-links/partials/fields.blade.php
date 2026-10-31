@php
    $link = $link ?? null;
@endphp

<div class="row mb-3">
    <div class="col-lg-2">
        <label for="network" class="form-label">{{ __('social_links.network') }} <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-10">
        <select name="network" id="network" class="form-select @error('network') is-invalid @enderror" required>
            <option value="">{{ __('social_links.network_select') }}</option>
            @foreach (\App\Enums\SocialNetwork::cases() as $network)
                <option value="{{ $network->value }}" @selected(old('network', $link?->network?->value) === $network->value)>{{ $network->label() }}</option>
            @endforeach
        </select>
        @error('network')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-lg-2">
        <label for="url" class="form-label">{{ __('social_links.url') }} <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-10">
        <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $link?->url) }}" placeholder="{{ __('social_links.url_placeholder') }}" required>
        @error('url')
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
            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', $link?->status?->value ?? 'active') === 'active')>
            <label class="form-check-label" for="status_active">{{ __('common.active') }}</label>
        </div>
        <div class="form-check form-check-inline form-radio-danger">
            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status', $link?->status?->value) === 'inactive')>
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
        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $link?->sort_order ?? 0) }}" min="0">
        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
