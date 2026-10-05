@extends('layouts.main')

@section('title', 'لیست فایل‌های صفایی')
@section('page-title', 'لیست فایل‌های صفایی')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item active">فایل‌ها</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">جستجو</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('safaei.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">دسته‌بندی</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="نام دسته‌بندی را وارد کنید">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">جستجو</button>
                                            <a href="{{ route('safaei.index') }}" class="btn btn-light">پاک کردن</a>
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
                    <h5 class="card-title mb-0">فایل‌ها</h5>
                    <a href="{{ route('safaei.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> افزودن فایل
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
                                    <th>دسته‌بندی</th>
                                    <th>فایل</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($files as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->category?->name ?: '—' }}</td>
                                        <td>{{ $item->fileName() }}</td>
                                        <td>{{ $item->created_at?->format('Y/m/d') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#safaeiModal{{ $item->id }}">نمایش</button>
                                                <a href="{{ route('safaei.edit', $item) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                                <form action="{{ route('safaei.destroy', $item) }}" method="POST" onsubmit="return confirm('این فایل حذف شود؟')">
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

                    @if ($files->hasPages())
                        <div class="mt-3">
                            {{ $files->links() }}
                        </div>
                    @endif

                    @foreach ($files as $item)
                        <div class="modal fade" id="safaeiModal{{ $item->id }}" tabindex="-1" aria-labelledby="safaeiModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="safaeiModalLabel{{ $item->id }}">لیست اطلاعات وارد شده</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">دسته‌بندی</dt>
                                            <dd class="col-sm-9">{{ $item->category?->name ?: '—' }}</dd>

                                            <dt class="col-sm-3">فایل</dt>
                                            <dd class="col-sm-9">
                                                @if ($item->file_path)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        @if ($item->isImageFile())
                                                            <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->fileName() }}" class="img-thumbnail" style="max-height: 160px;">
                                                        @else
                                                            <span>{{ $item->fileName() }}</span>
                                                        @endif
                                                        <a href="{{ route('safaei.download', $item) }}" class="btn btn-sm btn-primary">دانلود فایل</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">تاریخ ثبت</dt>
                                            <dd class="col-sm-9 mb-0">{{ $item->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>
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
