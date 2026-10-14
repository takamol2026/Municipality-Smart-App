@extends('layouts.main')

@section('title', __('safaei.create'))
@section('page-title', __('safaei.create'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('safaei.index') }}">{{ __('safaei.title') }}</a></li>
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
                    <form action="{{ route('safaei.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="safaei_category_id" class="form-label">{{ __('common.category') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="safaei_category_id" id="safaei_category_id" class="form-select @error('safaei_category_id') is-invalid @enderror" required>
                                            <option value="">{{ __('common.category_select') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('safaei_category_id') == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('safaei_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="file" class="form-label">{{ __('common.file') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
                                            <a href="{{ route('safaei.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
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
