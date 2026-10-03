@extends('layouts.main')

@section('title', 'لیست علما')
@section('page-title', 'لیست علما')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">داشبورد</a></li>
    <li class="breadcrumb-item active">علما</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">علما</h5>
                    <a href="{{ route('scholars.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> افزودن عالم
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
                                    <th>اسلاگ</th>
                                    <th>وضعیت</th>
                                    <th>ترتیب</th>
                                    <th>تاریخ ثبت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($scholars as $scholar)
                                    <tr>
                                        <td>{{ $scholar->id }}</td>
                                        <td>{{ $scholar->name }}</td>
                                        <td>{{ $scholar->slug }}</td>
                                        <td>
                                            @if ($scholar->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">فعال</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">غیرفعال</span>
                                            @endif
                                        </td>
                                        <td>{{ $scholar->sort_order }}</td>
                                        <td>{{ $scholar->created_at?->format('Y/m/d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">موردی ثبت نشده است.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($scholars->hasPages())
                        <div class="mt-3">
                            {{ $scholars->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
