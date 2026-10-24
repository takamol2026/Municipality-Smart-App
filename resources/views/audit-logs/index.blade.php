@extends('layouts.main')

@section('title', __('audit.list'))
@section('page-title', __('audit.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('audit.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('audit-logs.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="user_id" class="form-label">{{ __('audit.user') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="user_id" id="user_id" class="form-select">
                                            <option value="">{{ __('audit.all_users') }}</option>
                                            <option value="guest" @selected(request('user_id') === 'guest')>{{ __('audit.guest') }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @selected((string) request('user_id') === (string) $user->id)>
                                                    {{ trim($user->name.' '.$user->last_name) ?: $user->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="action" class="form-label">{{ __('audit.action') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="action" id="action" class="form-select">
                                            <option value="">{{ __('audit.all_actions') }}</option>
                                            @foreach ($actions as $action)
                                                <option value="{{ $action->value }}" @selected(request('action') === $action->value)>{{ $action->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="subject" class="form-label">{{ __('audit.subject') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="subject" id="subject" class="form-select">
                                            <option value="">{{ __('audit.all_subjects') }}</option>
                                            <option value="auth" @selected(request('subject') === 'auth')>{{ __('audit.auth_subject') }}</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject }}" @selected(request('subject') === $subject)>{{ __('audit.subjects.'.class_basename($subject)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="from" class="form-label">{{ __('audit.from') }}</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" name="from" id="from" data-jdp data-jdp-only-date class="form-control" value="{{ request('from') }}" placeholder="{{ __('audit.from') }}" autocomplete="off">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="to" class="form-label">{{ __('audit.to') }}</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" name="to" id="to" data-jdp data-jdp-only-date class="form-control" value="{{ request('to') }}" placeholder="{{ __('audit.to') }}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="q" class="form-label">{{ __('audit.search') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="q" id="q" class="form-control" value="{{ request('q') }}" placeholder="{{ __('audit.search_placeholder') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.search') }}</button>
                                            <a href="{{ route('audit-logs.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('audit.title') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('audit.user') }}</th>
                                    <th>{{ __('audit.action') }}</th>
                                    <th>{{ __('audit.subject') }}</th>
                                    <th>{{ __('audit.record') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $log)
                                    <tr>
                                        <td>{{ $logs->firstItem() + $loop->index }}</td>
                                        <td>{{ jalali_date($log->created_at, 'Y/m/d H:i') }}</td>
                                        <td>{{ $log->actorName() }}</td>
                                        <td><span class="badge {{ $log->action->badgeClass() }}">{{ $log->action->label() }}</span></td>
                                        <td>{{ $log->subjectLabel() }}</td>
                                        <td>{{ $log->record_label ?: '—' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#auditModal{{ $log->id }}">{{ __('audit.details') }}</button>
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

                    @if ($logs->hasPages())
                        <div class="mt-3">
                            {{ $logs->links() }}
                        </div>
                    @endif

                    @foreach ($logs as $log)
                        <div class="modal fade" id="auditModal{{ $log->id }}" tabindex="-1" aria-labelledby="auditModalLabel{{ $log->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="auditModalLabel{{ $log->id }}">{{ __('audit.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-3">
                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ jalali_date($log->created_at, 'Y/m/d H:i') }}</dd>

                                            <dt class="col-sm-3">{{ __('audit.user') }}</dt>
                                            <dd class="col-sm-9">{{ $log->actorName() }}</dd>

                                            <dt class="col-sm-3">{{ __('audit.action') }}</dt>
                                            <dd class="col-sm-9">{{ $log->action->label() }}</dd>

                                            <dt class="col-sm-3">{{ __('audit.subject') }}</dt>
                                            <dd class="col-sm-9">{{ $log->subjectLabel() }}</dd>

                                            <dt class="col-sm-3">{{ __('audit.record') }}</dt>
                                            <dd class="col-sm-9">{{ $log->record_label ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('audit.ip') }}</dt>
                                            <dd class="col-sm-9">{{ $log->ip_address ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('audit.url') }}</dt>
                                            <dd class="col-sm-9 text-break">{{ $log->url ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('audit.user_agent') }}</dt>
                                            <dd class="col-sm-9 text-break">{{ $log->user_agent ?: '—' }}</dd>
                                        </dl>

                                        @if ($log->changedFields() === [])
                                            <p class="text-muted mb-0">{{ __('audit.no_changes') }}</p>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('audit.field') }}</th>
                                                            <th>{{ __('audit.old_value') }}</th>
                                                            <th>{{ __('audit.new_value') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($log->changedFields() as $field)
                                                            <tr>
                                                                <td>{{ $log->fieldLabel($field) }}</td>
                                                                <td class="text-break">{{ $log->presentValue($field, $log->old_values[$field] ?? null) }}</td>
                                                                <td class="text-break">{{ $log->presentValue($field, $log->new_values[$field] ?? null) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
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

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/assets/libs/jalalidatepicker/jalalidatepicker.min.css') }}">
@endpush

@push('scripts')
    @include('partials.jalali-datepicker')
@endpush
