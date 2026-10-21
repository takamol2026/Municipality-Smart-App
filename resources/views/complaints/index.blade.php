@extends('layouts.main')

@section('title', __('complaints.list'))
@section('page-title', __('complaints.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('complaints.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('complaints.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('complaints.title_label') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('complaints.title_placeholder') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('complaints.status') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        @foreach (\App\Enums\ComplaintStatus::cases() as $status)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="status_{{ $status->value }}" value="{{ $status->value }}" @checked(request('status') === $status->value)>
                                                <label class="form-check-label" for="status_{{ $status->value }}">{{ $status->label() }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.search') }}</button>
                                            <a href="{{ route('complaints.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('complaints.title') }}</h5>
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
                                    <th>{{ __('complaints.title_label') }}</th>
                                    <th>{{ __('complaints.description') }}</th>
                                    <th>{{ __('complaints.status') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($complaints as $complaint)
                                    <tr>
                                        <td>{{ $complaints->firstItem() + $loop->index }}</td>
                                        <td>{{ $complaint->title }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($complaint->description, 80) }}</td>
                                        <td>
                                            @switch($complaint->status)
                                                @case(\App\Enums\ComplaintStatus::Pending)
                                                    <span class="badge bg-warning-subtle text-warning">{{ $complaint->status->label() }}</span>
                                                    @break
                                                @case(\App\Enums\ComplaintStatus::Reviewing)
                                                    <span class="badge bg-info-subtle text-info">{{ $complaint->status->label() }}</span>
                                                    @break
                                                @case(\App\Enums\ComplaintStatus::Resolved)
                                                    <span class="badge bg-success-subtle text-success">{{ $complaint->status->label() }}</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-danger-subtle text-danger">{{ $complaint->status->label() }}</span>
                                            @endswitch
                                        </td>
                                        <td>{{ jalali_date($complaint->created_at) }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#complaintModal{{ $complaint->id }}">{{ __('common.show') }}</button>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#complaintStatusModal{{ $complaint->id }}">{{ __('complaints.change_status') }}</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">{{ __('common.empty') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($complaints->hasPages())
                        <div class="mt-3">
                            {{ $complaints->links() }}
                        </div>
                    @endif

                    @foreach ($complaints as $complaint)
                        <div class="modal fade" id="complaintModal{{ $complaint->id }}" tabindex="-1" aria-labelledby="complaintModalLabel{{ $complaint->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="complaintModalLabel{{ $complaint->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('complaints.title_label') }}</dt>
                                            <dd class="col-sm-9">{{ $complaint->title }}</dd>

                                            <dt class="col-sm-3">{{ __('complaints.description') }}</dt>
                                            <dd class="col-sm-9">{{ $complaint->description }}</dd>

                                            <dt class="col-sm-3">{{ __('complaints.status') }}</dt>
                                            <dd class="col-sm-9">{{ $complaint->status->label() }}</dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ jalali_date($complaint->created_at, 'Y/m/d H:i') }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="complaintStatusModal{{ $complaint->id }}" tabindex="-1" aria-labelledby="complaintStatusModalLabel{{ $complaint->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('complaints.update', $complaint) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="complaintStatusModalLabel{{ $complaint->id }}">{{ __('complaints.change_status') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-3">{{ $complaint->title }}</p>
                                            @foreach (\App\Enums\ComplaintStatus::cases() as $status)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="status" id="complaint_{{ $complaint->id }}_status_{{ $status->value }}" value="{{ $status->value }}" @checked($complaint->status->value === $status->value) required>
                                                    <label class="form-check-label" for="complaint_{{ $complaint->id }}_status_{{ $status->value }}">{{ $status->label() }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('common.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
