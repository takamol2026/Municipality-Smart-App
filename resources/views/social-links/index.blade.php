@extends('layouts.main')

@section('title', __('social_links.list'))
@section('page-title', __('social_links.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('social_links.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('social-links.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="network" class="form-label">{{ __('social_links.network') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="network" id="network" class="form-select">
                                            <option value="">{{ __('social_links.network_all') }}</option>
                                            @foreach (\App\Enums\SocialNetwork::cases() as $network)
                                                <option value="{{ $network->value }}" @selected(request('network') === $network->value)>{{ $network->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="url" class="form-label">{{ __('social_links.url') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="url" id="url" class="form-control" value="{{ request('url') }}" placeholder="{{ __('social_links.url_placeholder') }}">
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
                                            <a href="{{ route('social-links.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('social_links.title') }}</h5>
                    <a href="{{ route('social-links.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> {{ __('social_links.create') }}
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
                                    <th>{{ __('social_links.network') }}</th>
                                    <th>{{ __('social_links.url') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('common.order') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($links as $link)
                                    <tr>
                                        <td>{{ $links->firstItem() + $loop->index }}</td>
                                        <td>{{ $link->network?->label() ?: '—' }}</td>
                                        <td>
                                            <a href="{{ $link->url }}" target="_blank" rel="noopener">{{ \Illuminate\Support\Str::limit($link->url, 60) }}</a>
                                        </td>
                                        <td>
                                            @if ($link->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">{{ __('common.active') }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">{{ __('common.inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $link->sort_order }}</td>
                                        <td>{{ jalali_date($link->created_at) }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#socialLinkModal{{ $link->id }}">{{ __('common.show') }}</button>
                                                <a href="{{ route('social-links.edit', $link) }}" class="btn btn-sm btn-primary">{{ __('common.edit') }}</a>
                                                <form action="{{ route('social-links.destroy', $link) }}" method="POST" onsubmit="return confirm(@json(__('social_links.delete_confirm')))">
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

                    @if ($links->hasPages())
                        <div class="mt-3">
                            {{ $links->links() }}
                        </div>
                    @endif

                    @foreach ($links as $link)
                        <div class="modal fade" id="socialLinkModal{{ $link->id }}" tabindex="-1" aria-labelledby="socialLinkModalLabel{{ $link->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="socialLinkModalLabel{{ $link->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('social_links.network') }}</dt>
                                            <dd class="col-sm-9">{{ $link->network?->label() ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('social_links.url') }}</dt>
                                            <dd class="col-sm-9"><a href="{{ $link->url }}" target="_blank" rel="noopener">{{ $link->url }}</a></dd>

                                            <dt class="col-sm-3">{{ __('common.status') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($link->status === \App\Enums\RecordStatus::Active)
                                                    {{ __('common.active') }}
                                                @else
                                                    {{ __('common.inactive') }}
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.sort_order') }}</dt>
                                            <dd class="col-sm-9">{{ $link->sort_order }}</dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ jalali_date($link->created_at, 'Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.creator') }}</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($link->user?->name ?? '').' '.($link->user?->last_name ?? '')) ?: '—' }}</dd>
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
