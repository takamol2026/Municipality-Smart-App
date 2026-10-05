@extends('layouts.main')

@section('title', 'لیست پروژه‌ها')
@section('page-title', 'لیست پروژه‌ها')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item active">پروژه‌ها</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">جستجو</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">عنوان</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="عنوان پروژه را وارد کنید">
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
                                            <a href="{{ route('projects.index') }}" class="btn btn-light">پاک کردن</a>
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
                    <h5 class="card-title mb-0">پروژه‌ها</h5>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> افزودن پروژه
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
                                    <th>انتشار</th>
                                    <th>ترتیب</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->category?->name ?: '—' }}</td>
                                        <td>
                                            @if ($project->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">فعال</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">غیرفعال</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($project->status_publish === \App\Enums\PublishStatus::Completed)
                                                <span class="badge bg-success-subtle text-success">{{ $project->status_publish->label() }}</span>
                                            @elseif ($project->status_publish === \App\Enums\PublishStatus::InProgress)
                                                <span class="badge bg-warning-subtle text-warning">{{ $project->status_publish->label() }}</span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary">{{ $project->status_publish->label() }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $project->sort_order }}</td>
                                        <td>{{ $project->start_date?->format('Y/m/d') ?: '—' }}</td>
                                        <td>{{ $project->created_at?->format('Y/m/d') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">نمایش</button>
                                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('این پروژه حذف شود؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">موردی ثبت نشده است.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($projects->hasPages())
                        <div class="mt-3">
                            {{ $projects->links() }}
                        </div>
                    @endif

                    @foreach ($projects as $project)
                        <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1" aria-labelledby="projectModalLabel{{ $project->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="projectModalLabel{{ $project->id }}">لیست اطلاعات وارد شده</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">عنوان</dt>
                                            <dd class="col-sm-9">{{ $project->title }}</dd>

                                            <dt class="col-sm-3">دسته‌بندی</dt>
                                            <dd class="col-sm-9">{{ $project->category?->name ?: '—' }}</dd>

                                            <dt class="col-sm-3">اسلاگ</dt>
                                            <dd class="col-sm-9">{{ $project->slug ?: '—' }}</dd>

                                            <dt class="col-sm-3">وضعیت</dt>
                                            <dd class="col-sm-9">
                                                @if ($project->status === \App\Enums\RecordStatus::Active)
                                                    فعال
                                                @else
                                                    غیرفعال
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">انتشار</dt>
                                            <dd class="col-sm-9">{{ $project->status_publish?->label() ?: '—' }}</dd>

                                            <dt class="col-sm-3">ترتیب نمایش</dt>
                                            <dd class="col-sm-9">{{ $project->sort_order }}</dd>

                                            <dt class="col-sm-3">موقعیت</dt>
                                            <dd class="col-sm-9">{{ $project->location ?: '—' }}</dd>

                                            <dt class="col-sm-3">تاریخ شروع</dt>
                                            <dd class="col-sm-9">{{ $project->start_date?->format('Y/m/d') ?: '—' }}</dd>

                                            <dt class="col-sm-3">تاریخ پایان</dt>
                                            <dd class="col-sm-9">{{ $project->end_date?->format('Y/m/d') ?: '—' }}</dd>

                                            <dt class="col-sm-3">توضیح کوتاه</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $project->short_description ?: '—' }}</dd>

                                            <dt class="col-sm-3">توضیحات</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $project->description ?: '—' }}</dd>

                                            <dt class="col-sm-3">مزایا</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $project->benefits ?: '—' }}</dd>

                                            <dt class="col-sm-3">تصویر</dt>
                                            <dd class="col-sm-9">
                                                @if ($project->image)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-height: 160px;">
                                                        <a href="{{ route('projects.image', $project) }}" class="btn btn-sm btn-primary">دانلود تصویر</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">رسانه‌ها</dt>
                                            <dd class="col-sm-9">
                                                @if ($project->media->isNotEmpty())
                                                    <div class="d-flex flex-wrap gap-3">
                                                        @foreach ($project->media as $media)
                                                            <div class="d-flex flex-column align-items-start gap-2">
                                                                @if ($media->previewPath())
                                                                    <img src="{{ asset('storage/'.$media->previewPath()) }}" alt="{{ $media->title ?: $project->title }}" class="img-thumbnail" style="width: 140px; height: 140px; object-fit: cover;">
                                                                @elseif ($media->isVideoFile())
                                                                    <span class="badge bg-info-subtle text-info">ویدیو</span>
                                                                @else
                                                                    <span class="badge bg-secondary-subtle text-secondary">{{ $media->typeLabel() }}</span>
                                                                @endif
                                                                <div class="small">{{ $media->title ?: 'بدون عنوان' }} — {{ $media->typeLabel() }}</div>
                                                                @if ($media->file)
                                                                    <a href="{{ route('projects.media.download', [$project, $media]) }}" class="btn btn-sm btn-primary">دانلود</a>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">تاریخ ثبت</dt>
                                            <dd class="col-sm-9">{{ $project->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">ثبت‌کننده</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($project->user?->name ?? '').' '.($project->user?->last_name ?? '')) ?: '—' }}</dd>
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
