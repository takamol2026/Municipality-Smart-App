@extends('layouts.main')

@section('title', 'افزودن فایل صفایی')
@section('page-title', 'افزودن فایل صفایی')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item"><a href="{{ route('safaei.index') }}">فایل‌ها</a></li>
    <li class="breadcrumb-item active">افزودن</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">فورم ذخیر سازی اطلاعات</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('safaei.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="safaei_category_id" class="form-label">دسته‌بندی <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="safaei_category_id" id="safaei_category_id" class="form-select @error('safaei_category_id') is-invalid @enderror" required>
                                            <option value="">دسته‌بندی را انتخاب کنید</option>
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
                                        <label for="file" class="form-label">فایل <span class="text-danger">*</span></label>
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
                                            <button type="submit" class="btn btn-primary">ذخیره</button>
                                            <a href="{{ route('safaei.index') }}" class="btn btn-light">انصراف</a>
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
