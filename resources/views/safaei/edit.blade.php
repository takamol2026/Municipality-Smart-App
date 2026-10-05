@extends('layouts.main')

@section('title', 'ویرایش فایل صفایی')
@section('page-title', 'ویرایش فایل صفایی')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item"><a href="{{ route('safaei.index') }}">فایل‌ها</a></li>
    <li class="breadcrumb-item active">ویرایش</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">فورم ویرایش اطلاعات</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('safaei.update', $safaei) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                                <option value="{{ $category->id }}" @selected(old('safaei_category_id', $safaei->safaei_category_id) == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('safaei_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="file" class="form-label">فایل</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($safaei->file_path)
                                            <div class="mt-2 d-flex flex-column align-items-start gap-2">
                                                @if ($safaei->isImageFile())
                                                    <img src="{{ asset('storage/'.$safaei->file_path) }}" alt="{{ $safaei->fileName() }}" class="img-thumbnail" style="max-height: 120px;">
                                                @else
                                                    <span>{{ $safaei->fileName() }}</span>
                                                @endif
                                                <a href="{{ route('safaei.download', $safaei) }}" class="btn btn-sm btn-primary">دانلود فایل</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">ویرایش</button>
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
