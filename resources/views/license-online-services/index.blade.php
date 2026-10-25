@extends('layouts.main')

@section('title', __('license_online_services.list'))
@section('page-title', __('license_online_services.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('license_online_services.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('license-online-services.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('common.name') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('license_online_services.name_placeholder') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="type" class="form-label">{{ __('license_online_services.type') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="type" id="type" class="form-select">
                                            <option value="">{{ __('license_online_services.type_all') }}</option>
                                            @foreach (\App\Enums\LicenseOnlineServiceType::cases() as $type)
                                                <option value="{{ $type->value }}" @selected(request('type') === $type->value)>{{ $type->label() }}</option>
                                            @endforeach
                                        </select>
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
                                            <a href="{{ route('license-online-services.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('license_online_services.title') }}</h5>
                    <a href="{{ route('license-online-services.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> {{ __('license_online_services.create') }}
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
                                    <th>{{ __('common.image') }}</th>
                                    <th>{{ __('common.name') }}</th>
                                    <th>{{ __('license_online_services.type') }}</th>
                                    <th>{{ __('common.lang') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('common.order') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($services as $service)
                                    <tr>
                                        <td>{{ $services->firstItem() + $loop->index }}</td>
                                        <td>
                                            @if ($service->image)
                                                <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->name }}" class="img-thumbnail" style="width: 56px; height: 56px; object-fit: cover;">
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->type?->label() ?: '—' }}</td>
                                        <td>{{ $service->lang?->label() ?: '—' }}</td>
                                        <td>
                                            @if ($service->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">{{ __('common.active') }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">{{ __('common.inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $service->sort_order }}</td>
                                        <td>{{ jalali_date($service->created_at) }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#licenseServiceModal{{ $service->id }}">{{ __('common.show') }}</button>
                                                <a href="{{ route('license-online-services.edit', $service) }}" class="btn btn-sm btn-primary">{{ __('common.edit') }}</a>
                                                <form action="{{ route('license-online-services.destroy', $service) }}" method="POST" onsubmit="return confirm(@json(__('license_online_services.delete_confirm')))">
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

                    @if ($services->hasPages())
                        <div class="mt-3">
                            {{ $services->links() }}
                        </div>
                    @endif

                    @foreach ($services as $service)
                        <div class="modal fade" id="licenseServiceModal{{ $service->id }}" tabindex="-1" aria-labelledby="licenseServiceModalLabel{{ $service->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="licenseServiceModalLabel{{ $service->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('common.name') }}</dt>
                                            <dd class="col-sm-9">{{ $service->name }}</dd>

                                            <dt class="col-sm-3">{{ __('license_online_services.type') }}</dt>
                                            <dd class="col-sm-9">{{ $service->type?->label() ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.lang') }}</dt>
                                            <dd class="col-sm-9">{{ $service->lang?->label() ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.status') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($service->status === \App\Enums\RecordStatus::Active)
                                                    {{ __('common.active') }}
                                                @else
                                                    {{ __('common.inactive') }}
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.sort_order') }}</dt>
                                            <dd class="col-sm-9">{{ $service->sort_order }}</dd>

                                            <dt class="col-sm-3">{{ __('common.description') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $service->description ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.image') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($service->image)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->name }}" class="img-thumbnail" style="max-height: 160px;">
                                                        <a href="{{ route('license-online-services.image', $service) }}" class="btn btn-sm btn-primary">{{ __('common.download_image') }}</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('license_online_services.attachments') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($service->files->isEmpty())
                                                    {{ __('license_online_services.no_files') }}
                                                @else
                                                    <div class="list-group">
                                                        @foreach ($service->files as $file)
                                                            <div class="list-group-item d-flex flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    @if ($file->isImage())
                                                                        <img src="{{ asset('storage/'.$file->file_path) }}" alt="{{ $file->file_name }}" class="img-thumbnail" style="width: 56px; height: 56px; object-fit: cover;">
                                                                    @endif
                                                                    <div>
                                                                        <div class="fw-medium">{{ $file->file_name }}</div>
                                                                        <div class="text-muted small">{{ $file->sizeLabel() }}</div>
                                                                    </div>
                                                                </div>
                                                                <a href="{{ route('license-online-services.files.download', [$service, $file]) }}" class="btn btn-sm btn-primary">{{ __('common.download') }}</a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ jalali_date($service->created_at, 'Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.creator') }}</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($service->user?->name ?? '').' '.($service->user?->last_name ?? '')) ?: '—' }}</dd>
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
