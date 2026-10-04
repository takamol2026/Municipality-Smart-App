@extends('layouts.main')

@section('title', 'ویرایش منطقه')
@section('page-title', 'ویرایش منطقه')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item"><a href="{{ route('districts.index') }}">مناطق</a></li>
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
                                        <label for="name" class="form-label">نام <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $district->name) }}" placeholder="نام منطقه را وارد کنید" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">شماره / اسلاگ</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="text" name="number" id="number" aria-label="شماره" class="form-control @error('number') is-invalid @enderror" value="{{ old('number', $district->number) }}" placeholder="شماره منطقه را وارد کنید">
                                                @error('number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="slug" id="slug" aria-label="اسلاگ" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $district->slug) }}" placeholder="اختیاری — در صورت خالی بودن خودکار ساخته می‌شود">
                                                @error('slug')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">تلفن / ایمیل</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="text" name="phone" id="phone" aria-label="تلفن" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $district->phone) }}" placeholder="تلفن را وارد کنید">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" name="email" id="email" aria-label="ایمیل" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $district->email) }}" placeholder="ایمیل را وارد کنید">
                                                @error('email')
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
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', $district->status->value) === 'active')>
                                            <label class="form-check-label" for="status_active">فعال</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status', $district->status->value) === 'inactive')>
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
                                        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $district->sort_order) }}" min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="description" class="form-label">توضیحات</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="توضیحات را وارد کنید">{{ old('description', $district->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="address" class="form-label">آدرس</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="آدرس را وارد کنید">{{ old('address', $district->address) }}</textarea>
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
                                        @if ($district->image)
                                            <img src="{{ asset('storage/'.$district->image) }}" alt="{{ $district->name }}" class="img-thumbnail mt-2" style="max-height: 120px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="images" class="form-label">تصاویر</label>
                                    </div>
                                    <div class="col-lg-10">
                                        @if ($district->files->isNotEmpty())
                                            <div class="d-flex flex-wrap gap-3 mb-3">
                                                @foreach ($district->files as $file)
                                                    <div class="text-center">
                                                        <img src="{{ asset('storage/'.$file->location) }}" alt="{{ $district->name }}" class="img-thumbnail d-block mb-2" style="width: 120px; height: 120px; object-fit: cover;">
                                                        <button type="submit" form="delete-district-file-{{ $file->id }}" class="btn btn-sm btn-danger" onclick="return confirm('این تصویر حذف شود؟')">حذف</button>
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
                                            <button type="submit" class="btn btn-primary">ویرایش</button>
                                            <a href="{{ route('districts.index') }}" class="btn btn-light">انصراف</a>
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
