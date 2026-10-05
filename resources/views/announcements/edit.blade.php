@extends('layouts.main')

@section('title', 'ویرایش اطلاعیه')
@section('page-title', 'ویرایش اطلاعیه')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item"><a href="{{ route('announcements.index') }}">اطلاعیه‌ها</a></li>
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
                    <form action="{{ route('announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="title" class="form-label">عنوان <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $announcement->title) }}" placeholder="عنوان اطلاعیه را وارد کنید" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="announcement_category_id" class="form-label">دسته‌بندی <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="announcement_category_id" id="announcement_category_id" class="form-select @error('announcement_category_id') is-invalid @enderror" required>
                                            <option value="">دسته‌بندی را انتخاب کنید</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('announcement_category_id', $announcement->announcement_category_id) == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('announcement_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="slug" class="form-label">اسلاگ</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $announcement->slug) }}" placeholder="اختیاری — در صورت خالی بودن خودکار ساخته می‌شود">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">تاریخ انتشار / تاریخ انقضا</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="date" name="publish_date" id="publish_date" aria-label="تاریخ انتشار" class="form-control @error('publish_date') is-invalid @enderror" value="{{ old('publish_date', $announcement->publish_date?->format('Y-m-d')) }}">
                                                @error('publish_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" name="expire_date" id="expire_date" aria-label="تاریخ انقضا" class="form-control @error('expire_date') is-invalid @enderror" value="{{ old('expire_date', $announcement->expire_date?->format('Y-m-d')) }}">
                                                @error('expire_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">وضعیت <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', $announcement->status->value) === 'active')>
                                            <label class="form-check-label" for="status_active">فعال</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status', $announcement->status->value) === 'inactive')>
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
                                        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $announcement->sort_order) }}" min="0">
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
                                        <textarea name="short_description" id="short_description" rows="2" class="form-control @error('short_description') is-invalid @enderror" placeholder="توضیح کوتاه را وارد کنید">{{ old('short_description', $announcement->short_description) }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="content" class="form-label">محتوا</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="content" id="content" rows="4" class="form-control @error('content') is-invalid @enderror" placeholder="محتوا را وارد کنید">{{ old('content', $announcement->content) }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">تصویر / پیوست</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="file" name="image" id="image" aria-label="تصویر" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if ($announcement->image)
                                                    <img src="{{ asset('storage/'.$announcement->image) }}" alt="{{ $announcement->title }}" class="img-thumbnail mt-2" style="max-height: 120px;">
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="attachment" id="attachment" aria-label="پیوست" class="form-control @error('attachment') is-invalid @enderror">
                                                @error('attachment')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if ($announcement->attachment)
                                                    <div class="mt-2">
                                                        <a href="{{ route('announcements.attachment', $announcement) }}" class="btn btn-sm btn-light">دانلود پیوست فعلی</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">ویرایش</button>
                                            <a href="{{ route('announcements.index') }}" class="btn btn-light">انصراف</a>
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
