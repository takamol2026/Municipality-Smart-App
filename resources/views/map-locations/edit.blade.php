@extends('layouts.main')

@section('title', 'ویرایش مکان نقشه')
@section('page-title', 'ویرایش مکان نقشه')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item"><a href="{{ route('map-locations.index') }}">مکان‌ها</a></li>
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
                    <form action="{{ route('map-locations.update', $location) }}" method="POST" enctype="multipart/form-data">
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
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $location->name) }}" placeholder="نام مکان را وارد کنید" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="map_category_id" class="form-label">دسته‌بندی <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="map_category_id" id="map_category_id" class="form-select @error('map_category_id') is-invalid @enderror" required>
                                            <option value="">دسته‌بندی را انتخاب کنید</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('map_category_id', $location->map_category_id) == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('map_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="slug" class="form-label">اسلاگ</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $location->slug) }}" placeholder="اختیاری — در صورت خالی بودن خودکار ساخته می‌شود">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="address" class="form-label">آدرس</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror" placeholder="آدرس را وارد کنید">{{ old('address', $location->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="phone" class="form-label">تلفن</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $location->phone) }}" placeholder="شماره تلفن را وارد کنید">
                                        @error('phone')
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
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', $location->status->value) === 'active')>
                                            <label class="form-check-label" for="status_active">فعال</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status', $location->status->value) === 'inactive')>
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
                                        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $location->sort_order) }}" min="0">
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
                                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="توضیحات را وارد کنید">{{ old('description', $location->description) }}</textarea>
                                        @error('description')
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
                                        @if ($location->image)
                                            <img src="{{ asset('storage/'.$location->image) }}" alt="{{ $location->name }}" class="img-thumbnail mt-2" style="max-height: 120px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">رسانه‌ها</label>
                                    </div>
                                    <div class="col-lg-10">
                                        @foreach ($location->media as $media)
                                            <div class="border rounded p-3 mb-3">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-md-3">
                                                        @if ($media->previewPath())
                                                            <img src="{{ asset('storage/'.$media->previewPath()) }}" alt="{{ $location->name }}" class="img-thumbnail" style="max-height: 90px;">
                                                        @elseif ($media->isVideoFile())
                                                            <span class="badge bg-info-subtle text-info">ویدیو</span>
                                                        @else
                                                            <span class="badge bg-secondary-subtle text-secondary">{{ $media->typeLabel() }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">نوع</label>
                                                        <select name="existing_media[{{ $media->id }}][type]" class="form-select">
                                                            <option value="image" @selected(old('existing_media.'.$media->id.'.type', $media->type) === 'image')>تصویر</option>
                                                            <option value="video" @selected(old('existing_media.'.$media->id.'.type', $media->type) === 'video')>ویدیو</option>
                                                            <option value="document" @selected(old('existing_media.'.$media->id.'.type', $media->type) === 'document')>سند</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">جایگزینی فایل</label>
                                                        <input type="file" name="existing_media[{{ $media->id }}][file]" class="form-control @error('existing_media.'.$media->id.'.file') is-invalid @enderror">
                                                        @error('existing_media.'.$media->id.'.file')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="d-flex flex-column gap-2">
                                                            @if ($media->location)
                                                                <a href="{{ route('map-locations.media.download', [$location, $media]) }}" class="btn btn-sm btn-primary">دانلود</a>
                                                            @endif
                                                            <button type="submit" form="delete-map-media-{{ $media->id }}" class="btn btn-sm btn-danger" onclick="return confirm('این رسانه حذف شود؟')">حذف</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div id="map-media-rows">
                                            @foreach (old('media', []) as $index => $row)
                                                @include('map-locations.partials.media-row', ['index' => $index, 'row' => $row])
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light" id="add-map-media">افزودن رسانه</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">ویرایش</button>
                                            <a href="{{ route('map-locations.index') }}" class="btn btn-light">انصراف</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>

                    @foreach ($location->media as $media)
                        <form id="delete-map-media-{{ $media->id }}" action="{{ route('map-locations.media.destroy', [$location, $media]) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach

                    <template id="map-media-row-template">
                        @include('map-locations.partials.media-row', ['index' => '__INDEX__', 'row' => ['type' => 'image']])
                    </template>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const rows = document.getElementById('map-media-rows');
            const addButton = document.getElementById('add-map-media');
            const template = document.getElementById('map-media-row-template');

            if (!rows || !addButton || !template) {
                return;
            }

            addButton.addEventListener('click', function () {
                const index = Date.now();
                const wrapper = document.createElement('div');
                wrapper.innerHTML = template.innerHTML.replaceAll('__INDEX__', String(index));
                rows.appendChild(wrapper.firstElementChild);
            });

            rows.addEventListener('click', function (event) {
                const button = event.target.closest('.remove-map-media');
                if (!button) {
                    return;
                }

                const row = button.closest('.map-media-row');
                if (row) {
                    row.remove();
                }
            });
        })();
    </script>
@endpush
