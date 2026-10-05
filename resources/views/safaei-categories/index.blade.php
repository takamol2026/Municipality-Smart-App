@extends('layouts.main')

@section('title', 'لیست دسته‌بندی صفایی')
@section('page-title', 'لیست دسته‌بندی صفایی')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item active">دسته‌بندی‌ها</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">جستجو</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('safaei-categories.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">نام</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="نام دسته‌بندی را وارد کنید">
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
                                            <a href="{{ route('safaei-categories.index') }}" class="btn btn-light">پاک کردن</a>
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
                    <h5 class="card-title mb-0">دسته‌بندی‌ها</h5>
                    <a href="{{ route('safaei-categories.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> افزودن دسته‌بندی
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            @if ($category->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">فعال</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">غیرفعال</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->created_at?->format('Y/m/d') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#categoryModal{{ $category->id }}">نمایش</button>
                                                <a href="{{ route('safaei-categories.edit', $category) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                                <form action="{{ route('safaei-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('این دسته‌بندی حذف شود؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">موردی ثبت نشده است.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($categories->hasPages())
                        <div class="mt-3">
                            {{ $categories->links() }}
                        </div>
                    @endif

                    @foreach ($categories as $category)
                        <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="categoryModalLabel{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="categoryModalLabel{{ $category->id }}">لیست اطلاعات وارد شده</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">نام</dt>
                                            <dd class="col-sm-9">{{ $category->name }}</dd>

                                            <dt class="col-sm-3">وضعیت</dt>
                                            <dd class="col-sm-9">
                                                @if ($category->status === \App\Enums\RecordStatus::Active)
                                                    فعال
                                                @else
                                                    غیرفعال
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">توضیحات</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $category->description ?: '—' }}</dd>

                                            <dt class="col-sm-3">تاریخ ثبت</dt>
                                            <dd class="col-sm-9">{{ $category->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">ثبت‌کننده</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($category->user?->name ?? '').' '.($category->user?->last_name ?? '')) ?: '—' }}</dd>
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
