@extends('layouts.main')

@section('title', 'لیست مکان‌های نقشه')
@section('page-title', 'لیست مکان‌های نقشه')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item active">مکان‌ها</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">جستجو</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('map-locations.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">نام</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="نام مکان را وارد کنید">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">وضعیت</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input" type="radio" name="status" id="status_active" value="active" @checked(request('status') === 'active')>
                                            <label class="form-check-label" for="status_active">فعال</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="inactive" @checked(request('status') === 'inactive')>
                                            <label class="form-check-label" for="status_inactive">غیرفعال</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">جستجو</button>
                                            <a href="{{ route('map-locations.index') }}" class="btn btn-light">پاک کردن</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">مکان‌ها</h5>
                    <a href="{{ route('map-locations.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> افزودن مکان
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>دسته‌بندی</th>
                                    <th>تلفن</th>
                                    <th>وضعیت</th>
                                    <th>ترتیب</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($locations as $location)
                                    <tr>
                                        <td>{{ $location->id }}</td>
                                        <td>{{ $location->name }}</td>
                                        <td>{{ $location->category?->name ?: '—' }}</td>
                                        <td>{{ $location->phone ?: '—' }}</td>
                                        <td>
                                            @if ($location->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">فعال</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">غیرفعال</span>
                                            @endif
                                        </td>
                                        <td>{{ $location->sort_order }}</td>
                                        <td>{{ $location->created_at?->format('Y/m/d') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#locationModal{{ $location->id }}">نمایش</button>
                                                <a href="{{ route('map-locations.edit', $location) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                                <form action="{{ route('map-locations.destroy', $location) }}" method="POST" onsubmit="return confirm('این مکان حذف شود؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">موردی ثبت نشده است.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($locations->hasPages())
                        <div class="mt-3">
                            {{ $locations->links() }}
                        </div>
                    @endif

                    @foreach ($locations as $location)
                        <div class="modal fade" id="locationModal{{ $location->id }}" tabindex="-1" aria-labelledby="locationModalLabel{{ $location->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="locationModalLabel{{ $location->id }}">لیست اطلاعات وارد شده</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">نام</dt>
                                            <dd class="col-sm-9">{{ $location->name }}</dd>

                                            <dt class="col-sm-3">دسته‌بندی</dt>
                                            <dd class="col-sm-9">{{ $location->category?->name ?: '—' }}</dd>

                                            <dt class="col-sm-3">اسلاگ</dt>
                                            <dd class="col-sm-9">{{ $location->slug ?: '—' }}</dd>

                                            <dt class="col-sm-3">وضعیت</dt>
                                            <dd class="col-sm-9">
                                                @if ($location->status === \App\Enums\RecordStatus::Active)
                                                    فعال
                                                @else
                                                    غیرفعال
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">ترتیب نمایش</dt>
                                            <dd class="col-sm-9">{{ $location->sort_order }}</dd>

                                            <dt class="col-sm-3">آدرس</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $location->address ?: '—' }}</dd>

                                            <dt class="col-sm-3">تلفن</dt>
                                            <dd class="col-sm-9">{{ $location->phone ?: '—' }}</dd>

                                            <dt class="col-sm-3">توضیحات</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $location->description ?: '—' }}</dd>

                                            <dt class="col-sm-3">تصویر</dt>
                                            <dd class="col-sm-9">
                                                @if ($location->image)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        <img src="{{ asset('storage/'.$location->image) }}" alt="{{ $location->name }}" class="img-thumbnail" style="max-height: 160px;">
                                                        <a href="{{ route('map-locations.image', $location) }}" class="btn btn-sm btn-primary">دانلود تصویر</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">رسانه‌ها</dt>
                                            <dd class="col-sm-9">
                                                @if ($location->media->isNotEmpty())
                                                    <div class="d-flex flex-wrap gap-3">
                                                        @foreach ($location->media as $media)
                                                            <div class="d-flex flex-column align-items-start gap-2">
                                                                @if ($media->previewPath())
                                                                    <img src="{{ asset('storage/'.$media->previewPath()) }}" alt="{{ $location->name }}" class="img-thumbnail" style="width: 140px; height: 140px; object-fit: cover;">
                                                                @elseif ($media->isVideoFile())
                                                                    <span class="badge bg-info-subtle text-info">ویدیو</span>
                                                                @else
                                                                    <span class="badge bg-secondary-subtle text-secondary">{{ $media->typeLabel() }}</span>
                                                                @endif
                                                                <div class="small">{{ $media->typeLabel() }}</div>
                                                                @if ($media->location)
                                                                    <a href="{{ route('map-locations.media.download', [$location, $media]) }}" class="btn btn-sm btn-primary">دانلود</a>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">تاریخ ثبت</dt>
                                            <dd class="col-sm-9">{{ $location->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">ثبت‌کننده</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($location->user?->name ?? '').' '.($location->user?->last_name ?? '')) ?: '—' }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
