@extends('layouts.main')

@section('title', __('projects.list'))
@section('page-title', __('projects.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('projects.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('projects.title_label') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('projects.title_placeholder') }}">
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
                                            <a href="{{ route('projects.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('projects.title') }}</h5>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> {{ __('projects.create') }}
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
                                    <th>{{ __('projects.title_label') }}</th>
                                    <th>{{ __('common.category') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('projects.publish') }}</th>
                                    <th>{{ __('common.order') }}</th>
                                    <th>{{ __('projects.start_date') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
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
                                                <span class="badge bg-success-subtle text-success">{{ __('common.active') }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">{{ __('common.inactive') }}</span>
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
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">{{ __('common.show') }}</button>
                                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-primary">{{ __('common.edit') }}</a>
                                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm(@json(__('projects.delete_confirm')))">
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
                                        <h5 class="modal-title" id="projectModalLabel{{ $project->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('projects.title_label') }}</dt>
                                            <dd class="col-sm-9">{{ $project->title }}</dd>

                                            <dt class="col-sm-3">{{ __('common.category') }}</dt>
                                            <dd class="col-sm-9">{{ $project->category?->name ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.slug') }}</dt>
                                            <dd class="col-sm-9">{{ $project->slug ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.status') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($project->status === \App\Enums\RecordStatus::Active)
                                                    {{ __('common.active') }}
                                                @else
                                                    {{ __('common.inactive') }}
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('projects.publish') }}</dt>
                                            <dd class="col-sm-9">{{ $project->status_publish?->label() ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.sort_order') }}</dt>
                                            <dd class="col-sm-9">{{ $project->sort_order }}</dd>

                                            <dt class="col-sm-3">{{ __('projects.location') }}</dt>
                                            <dd class="col-sm-9">{{ $project->location ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('projects.start_date') }}</dt>
                                            <dd class="col-sm-9">{{ $project->start_date?->format('Y/m/d') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('projects.end_date') }}</dt>
                                            <dd class="col-sm-9">{{ $project->end_date?->format('Y/m/d') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.short_description') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $project->short_description ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.description') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $project->description ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('projects.benefits') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $project->benefits ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.image') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($project->image)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-height: 160px;">
                                                        <a href="{{ route('projects.image', $project) }}" class="btn btn-sm btn-primary">{{ __('common.download_image') }}</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.media') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($project->media->isNotEmpty())
                                                    <div class="d-flex flex-wrap gap-3">
                                                        @foreach ($project->media as $media)
                                                            <div class="d-flex flex-column align-items-start gap-2">
                                                                @if ($media->previewPath())
                                                                    <img src="{{ asset('storage/'.$media->previewPath()) }}" alt="{{ $media->title ?: $project->title }}" class="img-thumbnail" style="width: 140px; height: 140px; object-fit: cover;">
                                                                @elseif ($media->isVideoFile())
                                                                    <span class="badge bg-info-subtle text-info">{{ __('common.video') }}</span>
                                                                @else
                                                                    <span class="badge bg-secondary-subtle text-secondary">{{ $media->typeLabel() }}</span>
                                                                @endif
                                                                <div class="small">{{ $media->title ?: __('common.untitled') }} — {{ $media->typeLabel() }}</div>
                                                                @if ($media->file)
                                                                    <a href="{{ route('projects.media.download', [$project, $media]) }}" class="btn btn-sm btn-primary">{{ __('common.download') }}</a>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ $project->created_at?->format('Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.creator') }}</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($project->user?->name ?? '').' '.($project->user?->last_name ?? '')) ?: '—' }}</dd>
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
