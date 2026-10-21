@extends('layouts.main')

@section('title', __('suggestions.list'))
@section('page-title', __('suggestions.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('suggestions.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('suggestions.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('suggestions.title_label') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('suggestions.title_placeholder') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('suggestions.status') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        @foreach (\App\Enums\SuggestionStatus::cases() as $status)
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
                                            <a href="{{ route('suggestions.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('suggestions.title') }}</h5>
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
                                    <th>{{ __('suggestions.title_label') }}</th>
                                    <th>{{ __('suggestions.description') }}</th>
                                    <th>{{ __('suggestions.status') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suggestions as $suggestion)
                                    <tr>
                                        <td>{{ $suggestions->firstItem() + $loop->index }}</td>
                                        <td>{{ $suggestion->title }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($suggestion->description, 80) }}</td>
                                        <td>
                                            @switch($suggestion->status)
                                                @case(\App\Enums\SuggestionStatus::Pending)
                                                    <span class="badge bg-warning-subtle text-warning">{{ $suggestion->status->label() }}</span>
                                                    @break
                                                @case(\App\Enums\SuggestionStatus::Reviewing)
                                                    <span class="badge bg-info-subtle text-info">{{ $suggestion->status->label() }}</span>
                                                    @break
                                                @case(\App\Enums\SuggestionStatus::Resolved)
                                                    <span class="badge bg-success-subtle text-success">{{ $suggestion->status->label() }}</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-danger-subtle text-danger">{{ $suggestion->status->label() }}</span>
                                            @endswitch
                                        </td>
                                        <td>{{ jalali_date($suggestion->created_at) }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#suggestionModal{{ $suggestion->id }}">{{ __('common.show') }}</button>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#suggestionStatusModal{{ $suggestion->id }}">{{ __('suggestions.change_status') }}</button>
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

                    @if ($suggestions->hasPages())
                        <div class="mt-3">
                            {{ $suggestions->links() }}
                        </div>
                    @endif

                    @foreach ($suggestions as $suggestion)
                        <div class="modal fade" id="suggestionModal{{ $suggestion->id }}" tabindex="-1" aria-labelledby="suggestionModalLabel{{ $suggestion->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="suggestionModalLabel{{ $suggestion->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('suggestions.title_label') }}</dt>
                                            <dd class="col-sm-9">{{ $suggestion->title }}</dd>

                                            <dt class="col-sm-3">{{ __('suggestions.description') }}</dt>
                                            <dd class="col-sm-9">{{ $suggestion->description }}</dd>

                                            <dt class="col-sm-3">{{ __('suggestions.status') }}</dt>
                                            <dd class="col-sm-9">{{ $suggestion->status->label() }}</dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ jalali_date($suggestion->created_at, 'Y/m/d H:i') }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="suggestionStatusModal{{ $suggestion->id }}" tabindex="-1" aria-labelledby="suggestionStatusModalLabel{{ $suggestion->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('suggestions.update', $suggestion) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="suggestionStatusModalLabel{{ $suggestion->id }}">{{ __('suggestions.change_status') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-3">{{ $suggestion->title }}</p>
                                            @foreach (\App\Enums\SuggestionStatus::cases() as $status)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="status" id="suggestion_{{ $suggestion->id }}_status_{{ $status->value }}" value="{{ $status->value }}" @checked($suggestion->status->value === $status->value) required>
                                                    <label class="form-check-label" for="suggestion_{{ $suggestion->id }}_status_{{ $status->value }}">{{ $status->label() }}</label>
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
