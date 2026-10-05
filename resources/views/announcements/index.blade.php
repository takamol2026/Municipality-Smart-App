@extends('layouts.main')

@section('title', 'لیست اطلاعیه‌ها')
@section('page-title', 'لیست اطلاعیه‌ها')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item active">اطلاعیه‌ها</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">جستجو</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('announcements.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">عنوان</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="عنوان اطلاعیه را وارد کنید">
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
                                            <a href="{{ route('announcements.index') }}" class="btn btn-light">پاک کردن</a>
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
                    <h5 class="card-title mb-0">اطلاعیه‌ها</h5>
                    <a href="{{ route('announcements.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> افزودن اطلاعیه
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
                                    <th>عنوان</th>
                                    <th>دسته‌بندی</th>
                                    <th>وضعیت</th>
                                    <th>ترتیب</th>
                                    <th>تاریخ انتشار</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->id }}</td>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ $announcement->category?->name ?: '—' }}</td>
                                        <td>
                                            @if ($announcement->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">فعال</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">غیرفعال</span>
                                            @endif
                                        </td>
                                        <td>{{ $announcement->sort_order }}</td>
                                        <td>{{ $announcement->publish_date?->format('Y/m/d') ?: '—' }}</td>
                                        <td>{{ $announcement->created_at?->format('Y/m/d') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#announcementModal{{ $announcement->id }}">نمایش</button>
                                                <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                                <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('این اطلاعیه حذف شود؟')">
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

                    @if ($announcements->hasPages())
                        <div class="mt-3">
                            {{ $announcements->links() }}
                        </div>
                    @endif

                    @foreach ($announcements as $announcement)
                        <div class="modal fade" id="announcementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="announcementModalLabel{{ $announcement->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="announcementModalLabel{{ $announcement->id }}">لیست اطلاعات وارد شده</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">عنوان</dt>
                                            <dd class="col-sm-9">{{ $announcement->title }}</dd>

                                            <dt class="col-sm-3">دسته‌بندی</dt>
                                            <dd class="col-sm-9">{{ $announcement->category?->name ?: '—' }}</dd>

                                            <dt class="col-sm-3">اسلاگ</dt>
                                            <dd class="col-sm-9">{{ $announcement->slug ?: '—' }}</dd>

                                            <dt class="col-sm-3">وضعیت</dt>
                                            <dd class="col-sm-9">
                                                @if ($announcement->status === \App\Enums\RecordStatus::Active)
                                                    فعال
                                                @else
                                                    غیرفعال
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">ترتیب نمایش</dt>
                                            <dd class="col-sm-9">{{ $announcement->sort_order }}</dd>

                                            <dt class="col-sm-3">تاریخ انتشار</dt>
                                            <dd class="col-sm-9">{{ $announcement->publish_date?->format('Y/m/d') ?: '—' }}</dd>

                                            <dt class="col-sm-3">تاریخ انقضا</dt>
                                            <dd class="col-sm-9">{{ $announcement->expire_date?->format('Y/m/d') ?: '—' }}</dd>

                                            <dt class="col-sm-3">توضیح کوتاه</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $announcement->short_description ?: '—' }}</dd>

                                            <dt class="col-sm-3">محتوا</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $announcement->content ?: '—' }}</dd>

                                            <dt class="col-sm-3">تصویر</dt>
                                            <dd class="col-sm-9">
                                                @if ($announcement->image)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        <img src="{{ asset('storage/'.$announcement->image) }}" alt="{{ $announcement->title }}" class="img-thumbnail" style="max-height: 160px;">
                                                        <a href="{{ route('announcements.image', $announcement) }}" class="btn btn-sm btn-primary">دانلود تصویر</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">پیوست</dt>
                                            <dd class="col-sm-9">
                                                @if ($announcement->attachment)
                                                    <a href="{{ route('announcements.attachment', $announcement) }}" class="btn btn-sm btn-primary">دانلود پیوست</a>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">تاریخ ثبت</dt>
                                            <dd class="col-sm-9">{{ $announcement->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">ثبت‌کننده</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($announcement->user?->name ?? '').' '.($announcement->user?->last_name ?? '')) ?: '—' }}</dd>
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
