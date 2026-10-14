@extends('layouts.main')

@section('title', __('scholars.list'))
@section('page-title', __('scholars.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('scholars.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('scholars.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('common.name') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('scholars.name_placeholder') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('common.status') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input" type="radio" name="status" id="status_active" value="active" @checked(request('status') === 'active')>
                                            <label class="form-check-label" for="status_active">{{ __('common.active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="inactive" @checked(request('status') === 'inactive')>
                                            <label class="form-check-label" for="status_inactive">{{ __('common.inactive') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.search') }}</button>
                                            <a href="{{ route('scholars.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('scholars.title') }}</h5>
                    <a href="{{ route('scholars.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> {{ __('scholars.create') }}
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
                                    <th>{{ __('common.name') }}</th>
                                    <th>{{ __('common.slug') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('common.order') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
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
                                                <span class="badge bg-success-subtle text-success">{{ __('common.active') }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">{{ __('common.inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $scholar->sort_order }}</td>
                                        <td>{{ $scholar->created_at?->format('Y/m/d') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#scholarModal{{ $scholar->id }}">{{ __('common.show') }}</button>
                                                <a href="{{ route('scholars.edit', $scholar) }}" class="btn btn-sm btn-primary">{{ __('common.edit') }}</a>
                                                <form action="{{ route('scholars.destroy', $scholar) }}" method="POST" onsubmit="return confirm(@json(__('scholars.delete_confirm')))">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('common.delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">{{ __('common.empty') }}</td>
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

                    @foreach ($scholars as $scholar)
                        <div class="modal fade" id="scholarModal{{ $scholar->id }}" tabindex="-1" aria-labelledby="scholarModalLabel{{ $scholar->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="scholarModalLabel{{ $scholar->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('common.name') }}</dt>
                                            <dd class="col-sm-9">{{ $scholar->name }}</dd>

                                            <dt class="col-sm-3">{{ __('common.slug') }}</dt>
                                            <dd class="col-sm-9">{{ $scholar->slug ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('scholars.birth_date') }}</dt>
                                            <dd class="col-sm-9">{{ $scholar->birth_date?->format('Y/m/d') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('scholars.death_date') }}</dt>
                                            <dd class="col-sm-9">{{ $scholar->death_date?->format('Y/m/d') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.status') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($scholar->status === \App\Enums\RecordStatus::Active)
                                                    {{ __('common.active') }}
                                                @else
                                                    {{ __('common.inactive') }}
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.sort_order') }}</dt>
                                            <dd class="col-sm-9">{{ $scholar->sort_order }}</dd>

                                            <dt class="col-sm-3">{{ __('scholars.short_bio') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $scholar->short_bio ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('scholars.biography') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $scholar->biography ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('scholars.education') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $scholar->education ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('scholars.works') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $scholar->works ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.image') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($scholar->image)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        <img src="{{ asset('storage/'.$scholar->image) }}" alt="{{ $scholar->name }}" class="img-thumbnail" style="max-height: 160px;">
                                                        <a href="{{ route('scholars.image', $scholar) }}" class="btn btn-sm btn-primary">{{ __('common.download_image') }}</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ $scholar->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.creator') }}</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($scholar->user?->name ?? '').' '.($scholar->user?->last_name ?? '')) ?: '—' }}</dd>
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
