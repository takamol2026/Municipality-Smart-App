@extends('layouts.main')

@section('title', __('districts.edit'))
@section('page-title', __('districts.edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('districts.index') }}">{{ __('districts.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('common.edit') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.edit_form') }}</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="district-update" action="{{ route('districts.update', $district) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('common.lang') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        @foreach (\App\Enums\Language::cases() as $language)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('lang') is-invalid @enderror" type="radio" name="lang" id="lang_{{ $language->value }}" value="{{ $language->value }}" @checked(old('lang', $district->lang?->value) === $language->value)>
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
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $district->name) }}" placeholder="{{ __('districts.name_placeholder') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('districts.number_slug') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="text" name="number" id="number" aria-label="{{ __('districts.number') }}" class="form-control @error('number') is-invalid @enderror" value="{{ old('number', $district->number) }}" placeholder="{{ __('districts.number_placeholder') }}">
                                                @error('number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="slug" id="slug" aria-label="{{ __('common.slug') }}" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $district->slug) }}" placeholder="{{ __('common.slug_placeholder') }}">
                                                @error('slug')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('districts.phone_email') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="text" name="phone" id="phone" aria-label="{{ __('common.phone') }}" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $district->phone) }}" placeholder="{{ __('common.phone_placeholder') }}">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" name="email" id="email" aria-label="{{ __('common.email') }}" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $district->email) }}" placeholder="{{ __('common.email_placeholder') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('common.status') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', $district->status->value) === 'active')>
                                            <label class="form-check-label" for="status_active">{{ __('common.active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status', $district->status->value) === 'inactive')>
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
                                        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $district->sort_order) }}" min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="description" class="form-label">{{ __('common.description') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('common.description_placeholder') }}">{{ old('description', $district->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="address" class="form-label">{{ __('common.address') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="{{ __('common.address_placeholder') }}">{{ old('address', $district->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="image" class="form-label">{{ __('common.image') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($district->image)
                                            <img src="{{ asset('storage/'.$district->image) }}" alt="{{ $district->name }}" class="img-thumbnail mt-2" style="max-height: 120px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="images" class="form-label">{{ __('common.images') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        @if ($district->files->isNotEmpty())
                                            <div class="d-flex flex-wrap gap-3 mb-3">
                                                @foreach ($district->files as $file)
                                                    <div class="text-center">
                                                        <img src="{{ asset('storage/'.$file->location) }}" alt="{{ $district->name }}" class="img-thumbnail d-block mb-2" style="width: 120px; height: 120px; object-fit: cover;">
                                                        <button type="submit" form="delete-district-file-{{ $file->id }}" class="btn btn-sm btn-danger" onclick="return confirm(@json(__('common.delete_image_confirm')))">{{ __('common.delete') }}</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <input type="file" name="images[]" id="images" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" accept="image/*" multiple>
                                        @error('images')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('images.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.edit') }}</button>
                                            <a href="{{ route('districts.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>

                    @foreach ($district->files as $file)
                        <form id="delete-district-file-{{ $file->id }}" action="{{ route('districts.files.destroy', [$district, $file]) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
