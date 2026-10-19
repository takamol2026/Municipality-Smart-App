@extends('layouts.main')

@section('title', __('districts.list'))
@section('page-title', __('districts.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('districts.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('districts.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('common.name') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('districts.name_placeholder') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('common.lang') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        @foreach (\App\Enums\Language::cases() as $language)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="lang" id="lang_{{ $language->value }}" value="{{ $language->value }}" @checked(request('lang') === $language->value)>
                                                <label class="form-check-label" for="lang_{{ $language->value }}">{{ $language->label() }}</label>
                                            </div>
                                        @endforeach
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
                                            <a href="{{ route('districts.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('districts.title') }}</h5>
                    <a href="{{ route('districts.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> {{ __('districts.create') }}
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
                                    <th>{{ __('common.lang') }}</th>
                                    <th>{{ __('districts.number') }}</th>
                                    <th>{{ __('common.slug') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('common.order') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($districts as $district)
                                    <tr>
                                        <td>{{ $districts->firstItem() + $loop->index }}</td>
                                        <td>{{ $district->name }}</td>
                                        <td>{{ $district->lang?->label() ?: '—' }}</td>
                                        <td>{{ $district->number ?: '—' }}</td>
                                        <td>{{ $district->slug }}</td>
                                        <td>
                                            @if ($district->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">{{ __('common.active') }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">{{ __('common.inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $district->sort_order }}</td>
                                        <td>{{ $district->created_at?->format('Y/m/d') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#districtModal{{ $district->id }}">{{ __('common.show') }}</button>
                                                <a href="{{ route('districts.edit', $district) }}" class="btn btn-sm btn-primary">{{ __('common.edit') }}</a>
                                                <form action="{{ route('districts.destroy', $district) }}" method="POST" onsubmit="return confirm(@json(__('districts.delete_confirm')))">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('common.delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">{{ __('common.empty') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($districts->hasPages())
                        <div class="mt-3">
                            {{ $districts->links() }}
                        </div>
                    @endif

                    @foreach ($districts as $district)
                        <div class="modal fade" id="districtModal{{ $district->id }}" tabindex="-1" aria-labelledby="districtModalLabel{{ $district->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="districtModalLabel{{ $district->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('common.name') }}</dt>
                                            <dd class="col-sm-9">{{ $district->name }}</dd>

                                            <dt class="col-sm-3">{{ __('common.lang') }}</dt>
                                            <dd class="col-sm-9">{{ $district->lang?->label() ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('districts.number') }}</dt>
                                            <dd class="col-sm-9">{{ $district->number ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.slug') }}</dt>
                                            <dd class="col-sm-9">{{ $district->slug ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.phone') }}</dt>
                                            <dd class="col-sm-9">{{ $district->phone ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.email') }}</dt>
                                            <dd class="col-sm-9">{{ $district->email ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.status') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($district->status === \App\Enums\RecordStatus::Active)
                                                    {{ __('common.active') }}
                                                @else
                                                    {{ __('common.inactive') }}
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.sort_order') }}</dt>
                                            <dd class="col-sm-9">{{ $district->sort_order }}</dd>

                                            <dt class="col-sm-3">{{ __('common.description') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $district->description ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.address') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $district->address ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.image') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($district->image)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        <img src="{{ asset('storage/'.$district->image) }}" alt="{{ $district->name }}" class="img-thumbnail" style="max-height: 160px;">
                                                        <a href="{{ route('districts.image', $district) }}" class="btn btn-sm btn-primary">{{ __('common.download_image') }}</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.images') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($district->files->isNotEmpty())
                                                    <div class="d-flex flex-wrap gap-3">
                                                        @foreach ($district->files as $file)
                                                            <div class="d-flex flex-column align-items-start gap-2">
                                                                <img src="{{ asset('storage/'.$file->location) }}" alt="{{ $district->name }}" class="img-thumbnail" style="width: 140px; height: 140px; object-fit: cover;">
                                                                <a href="{{ route('districts.files.download', [$district, $file]) }}" class="btn btn-sm btn-primary">{{ __('common.download_image') }}</a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ $district->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.creator') }}</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($district->user?->name ?? '').' '.($district->user?->last_name ?? '')) ?: '—' }}</dd>
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
