@extends('layouts.main')

@section('title', 'ویرایش جاذبه تاریخی')
@section('page-title', 'ویرایش جاذبه تاریخی')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item"><a href="{{ route('historical-attractions.index') }}">جاذبه‌های تاریخی</a></li>
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
                    <form action="{{ route('historical-attractions.update', $attraction) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">نام <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $attraction->name) }}" placeholder="نام جاذبه را وارد کنید" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="historical_attraction_category_id" class="form-label">دسته‌بندی <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="historical_attraction_category_id" id="historical_attraction_category_id" class="form-select @error('historical_attraction_category_id') is-invalid @enderror" required>
                                            <option value="">دسته‌بندی را انتخاب کنید</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('historical_attraction_category_id', $attraction->historical_attraction_category_id) == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('historical_attraction_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="slug" class="form-label">اسلاگ</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $attraction->slug) }}" placeholder="اختیاری — در صورت خالی بودن خودکار ساخته می‌شود">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">وضعیت <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', $attraction->status->value) === 'active')>
                                            <label class="form-check-label" for="status_active">فعال</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status', $attraction->status->value) === 'inactive')>
                                            <label class="form-check-label" for="status_inactive">غیرفعال</label>
                                        </div>
                                        @error('status')
                                            <div class="text-danger small d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="sort_order" class="form-label">ترتیب نمایش</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $attraction->sort_order) }}" min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="short_description" class="form-label">توضیح کوتاه</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="short_description" id="short_description" rows="2" class="form-control @error('short_description') is-invalid @enderror" placeholder="توضیح کوتاه را وارد کنید">{{ old('short_description', $attraction->short_description) }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="description" class="form-label">توضیحات</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="توضیحات را وارد کنید">{{ old('description', $attraction->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="history" class="form-label">تاریخچه</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="history" id="history" rows="3" class="form-control @error('history') is-invalid @enderror" placeholder="تاریخچه را وارد کنید">{{ old('history', $attraction->history) }}</textarea>
                                        @error('history')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="address" class="form-label">آدرس</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror" placeholder="آدرس را وارد کنید">{{ old('address', $attraction->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="image" class="form-label">تصویر</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($attraction->image)
                                            <img src="{{ asset('storage/'.$attraction->image) }}" alt="{{ $attraction->name }}" class="img-thumbnail mt-2" style="max-height: 120px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">ویرایش</button>
                                            <a href="{{ route('historical-attractions.index') }}" class="btn btn-light">انصراف</a>
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
