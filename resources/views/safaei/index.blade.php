@extends('layouts.main')

@section('title', __('safaei.list'))
@section('page-title', __('safaei.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('safaei.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('safaei.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('common.category') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('common.category_name_placeholder') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.search') }}</button>
                                            <a href="{{ route('safaei.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('safaei.title') }}</h5>
                    <a href="{{ route('safaei.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> {{ __('safaei.create_short') }}
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
                                    <th>{{ __('common.category') }}</th>
                                    <th>{{ __('common.file') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($files as $item)
                                    <tr>
                                        <td>{{ $files->firstItem() + $loop->index }}</td>
                                        <td>{{ $item->category?->name ?: '—' }}</td>
                                        <td>{{ $item->fileName() }}</td>
                                        <td>{{ $item->created_at?->format('Y/m/d') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#safaeiModal{{ $item->id }}">{{ __('common.show') }}</button>
                                                <a href="{{ route('safaei.edit', $item) }}" class="btn btn-sm btn-primary">{{ __('common.edit') }}</a>
                                                <form action="{{ route('safaei.destroy', $item) }}" method="POST" onsubmit="return confirm(@json(__('safaei.delete_confirm')))">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('common.delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">{{ __('common.empty') }}</td>
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
                                        <h5 class="modal-title" id="safaeiModalLabel{{ $item->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('common.category') }}</dt>
                                            <dd class="col-sm-9">{{ $item->category?->name ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.file') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($item->file_path)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        @if ($item->isImageFile())
                                                            <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->fileName() }}" class="img-thumbnail" style="max-height: 160px;">
                                                        @else
                                                            <span>{{ $item->fileName() }}</span>
                                                        @endif
                                                        <a href="{{ route('safaei.download', $item) }}" class="btn btn-sm btn-primary">{{ __('safaei.download') }}</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9 mb-0">{{ $item->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('common.close') }}</button>
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
