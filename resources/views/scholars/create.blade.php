@extends('layouts.main')

@section('title', __('scholars.create'))
@section('page-title', __('scholars.create'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('scholars.index') }}">{{ __('scholars.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('common.add') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.create_form') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('scholars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('common.name') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ __('scholars.name_placeholder') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="slug" class="form-label">{{ __('common.slug') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="{{ __('common.slug_placeholder') }}">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('scholars.dates') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="date" name="birth_date" id="birth_date" aria-label="{{ __('scholars.birth_date') }}" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                                                @error('birth_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" name="death_date" id="death_date" aria-label="{{ __('scholars.death_date') }}" class="form-control @error('death_date') is-invalid @enderror" value="{{ old('death_date') }}">
                                                @error('death_date')
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
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', 'active') === 'active')>
                                            <label class="form-check-label" for="status_active">{{ __('common.active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status') === 'inactive')>
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
                                        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}" min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="short_bio" class="form-label">{{ __('scholars.short_bio') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="short_bio" id="short_bio" rows="2" class="form-control @error('short_bio') is-invalid @enderror" placeholder="{{ __('scholars.short_bio_placeholder') }}">{{ old('short_bio') }}</textarea>
                                        @error('short_bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="biography" class="form-label">{{ __('scholars.biography') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="biography" id="biography" rows="4" class="form-control @error('biography') is-invalid @enderror" placeholder="{{ __('scholars.biography_placeholder') }}">{{ old('biography') }}</textarea>
                                        @error('biography')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="education" class="form-label">{{ __('scholars.education') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="education" id="education" rows="3" class="form-control @error('education') is-invalid @enderror" placeholder="{{ __('scholars.education_placeholder') }}">{{ old('education') }}</textarea>
                                        @error('education')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="works" class="form-label">{{ __('scholars.works') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="works" id="works" rows="3" class="form-control @error('works') is-invalid @enderror" placeholder="{{ __('scholars.works_placeholder') }}">{{ old('works') }}</textarea>
                                        @error('works')
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
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
                                            <a href="{{ route('scholars.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
