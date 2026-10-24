@extends('layouts.main')

@section('title', __('dashboard.title'))
@section('page-title', __('dashboard.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.title') }}</li>
@endsection

@section('content')
    <div class="row">
        @foreach ($stats as $stat)
            <div class="col-xl-3 col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="avatar-sm float-end">
                            <div class="avatar-title bg-{{ $stat['color'] }}-subtle text-{{ $stat['color'] }} fs-3xl rounded">
                                <i class="{{ $stat['icon'] }}"></i>
                            </div>
                        </div>
                        <h4><span class="counter-value" data-target="{{ $stat['count'] }}">0</span></h4>
                        <p class="text-muted mb-4">{{ $stat['label'] }}</p>
                        <a href="{{ $stat['route'] }}" class="text-muted mb-0">{{ __('dashboard.view_list') }}</a>
                    </div>
                    <div class="px-3 pb-3">
                        <div id="mini-chart-{{ $stat['key'] }}"
                             data-colors='["--tb-{{ $stat['color'] }}"]'
                             data-series='@json($stat['sparkline'])'
                             class="apex-charts"
                             dir="ltr"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row row-cols-xxl-6 row-cols-lg-3 row-cols-md-2 row-cols-1">
        @foreach ($tiles as $tile)
            <div class="col">
                <a href="{{ $tile['route'] }}" class="text-reset">
                    <div class="card border-bottom border-3 card-animate border-{{ $tile['color'] }}">
                        <div class="card-body">
                            <h4 class="mb-4"><span class="counter-value" data-target="{{ $tile['count'] }}">0</span></h4>
                            <p class="text-muted fw-medium text-uppercase mb-0">{{ $tile['label'] }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ __('dashboard.module_counts') }}</h4>
                </div>
                <div class="card-body">
                    <div id="column_chart"
                         data-colors='["--tb-primary"]'
                         class="apex-charts"
                         dir="ltr"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ __('dashboard.project_status') }}</h4>
                </div>
                <div class="card-body">
                    <div id="simple_dount_chart"
                         data-colors='["--tb-warning", "--tb-info", "--tb-success"]'
                         class="apex-charts"
                         dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ __('dashboard.monthly_activity') }}</h4>
                </div>
                <div class="card-body">
                    <div id="monthly_column_chart"
                         data-colors='["--tb-primary", "--tb-warning", "--tb-info"]'
                         class="apex-charts"
                         dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">{{ __('dashboard.recent_audits') }}</h4>
                    <a href="{{ route('audit-logs.index') }}" class="btn btn-sm btn-primary">{{ __('dashboard.view_audits') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('audit.user') }}</th>
                                    <th>{{ __('audit.action') }}</th>
                                    <th>{{ __('audit.subject') }}</th>
                                    <th>{{ __('audit.record') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentAudits as $log)
                                    <tr>
                                        <td>{{ jalali_date($log->created_at, 'Y/m/d H:i') }}</td>
                                        <td>{{ $log->actorName() }}</td>
                                        <td><span class="badge {{ $log->action->badgeClass() }}">{{ $log->action->label() }}</span></td>
                                        <td>{{ $log->subjectLabel() }}</td>
                                        <td>{{ $log->record_label ?: '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">{{ __('common.empty') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script>
        window.dashboardCharts = {
            module: @json($moduleChart),
            projectStatus: @json($projectStatusChart),
            monthly: @json($monthlyChart),
        };
    </script>
    <script src="{{ asset('assets/assets/js/pages/dashboard.init.js') }}"></script>
@endpush
