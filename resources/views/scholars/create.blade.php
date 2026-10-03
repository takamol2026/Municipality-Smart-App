@extends('layouts.main')

@section('title', 'افزودن عالم')
@section('page-title', 'افزودن عالم')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item"><a href="{{ route('scholars.index') }}">علما</a></li>
    <li class="breadcrumb-item active">افزودن</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">فرم ذخیره عالم</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('scholars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">نام <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">اسلاگ</label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="اختیاری — در صورت خالی بودن خودکار ساخته می‌شود">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">تاریخ تولد</label>
                                    <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="death_date" class="form-label">تاریخ وفات</label>
                                    <input type="date" name="death_date" id="death_date" class="form-control @error('death_date') is-invalid @enderror" value="{{ old('death_date') }}">
                                    @error('death_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">وضعیت <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="active" @selected(old('status', 'active') === 'active')>فعال</option>
                                        <option value="inactive" @selected(old('status') === 'inactive')>غیرفعال</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sort_order" class="form-label">ترتیب نمایش</label>
                                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="short_bio" class="form-label">بیوگرافی کوتاه</label>
                                    <textarea name="short_bio" id="short_bio" rows="2" class="form-control @error('short_bio') is-invalid @enderror">{{ old('short_bio') }}</textarea>
                                    @error('short_bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="biography" class="form-label">بیوگرافی کامل</label>
                                    <textarea name="biography" id="biography" rows="4" class="form-control @error('biography') is-invalid @enderror">{{ old('biography') }}</textarea>
                                    @error('biography')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="education" class="form-label">تحصیلات</label>
                                    <textarea name="education" id="education" rows="3" class="form-control @error('education') is-invalid @enderror">{{ old('education') }}</textarea>
                                    @error('education')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="works" class="form-label">آثار</label>
                                    <textarea name="works" id="works" rows="3" class="form-control @error('works') is-invalid @enderror">{{ old('works') }}</textarea>
                                    @error('works')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">تصویر</label>
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('scholars.index') }}" class="btn btn-light">انصراف</a>
                            <button type="submit" class="btn btn-primary">ذخیره</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
