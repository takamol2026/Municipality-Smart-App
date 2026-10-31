@extends('layouts.main')

@section('title', __('rentals.list'))
@section('page-title', __('rentals.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('rentals.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('rentals.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('common.name') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('rentals.name_placeholder') }}">
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
                                            <a href="{{ route('rentals.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('rentals.title') }}</h5>
                    <a href="{{ route('rentals.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> {{ __('rentals.create') }}
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
                                    <th>{{ __('common.category') }}</th>
                                    <th>{{ __('rentals.price') }}</th>
                                    <th>{{ __('rentals.duration') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('common.order') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rentals as $rental)
                                    <tr>
                                        <td>{{ $rentals->firstItem() + $loop->index }}</td>
                                        <td>{{ $rental->name }}</td>
                                        <td>{{ $rental->lang?->label() ?: '—' }}</td>
                                        <td>{{ $rental->category?->name ?: '—' }}</td>
                                        <td>{{ $rental->rental_price !== null ? number_format($rental->rental_price) : '—' }}</td>
                                        <td>{{ $rental->rental_period !== null ? __('rentals.days', ['count' => $rental->rental_period]) : '—' }}</td>
                                        <td>
                                            @if ($rental->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">{{ __('common.active') }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">{{ __('common.inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $rental->sort_order }}</td>
                                        <td>{{ jalali_date($rental->created_at) }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#rentalModal{{ $rental->id }}">{{ __('common.show') }}</button>
                                                <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-sm btn-primary">{{ __('common.edit') }}</a>
                                                <form action="{{ route('rentals.destroy', $rental) }}" method="POST" onsubmit="return confirm(@json(__('rentals.delete_confirm')))">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('common.delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">{{ __('common.empty') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($rentals->hasPages())
                        <div class="mt-3">
                            {{ $rentals->links() }}
                        </div>
                    @endif

                    @foreach ($rentals as $rental)
                        <div class="modal fade" id="rentalModal{{ $rental->id }}" tabindex="-1" aria-labelledby="rentalModalLabel{{ $rental->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rentalModalLabel{{ $rental->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('common.name') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->name }}</dd>

                                            <dt class="col-sm-3">{{ __('common.lang') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->lang?->label() ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.category') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->category?->name ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.slug') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->slug ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.status') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($rental->status === \App\Enums\RecordStatus::Active)
                                                    {{ __('common.active') }}
                                                @else
                                                    {{ __('common.inactive') }}
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.sort_order') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->sort_order }}</dd>

                                            <dt class="col-sm-3">{{ __('rentals.price') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->rental_price !== null ? number_format($rental->rental_price) : '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('rentals.period') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->rental_period !== null ? __('rentals.days', ['count' => $rental->rental_period]) : '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.address') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $rental->address ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('rentals.latitude') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->latitude ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('rentals.longitude') }}</dt>
                                            <dd class="col-sm-9">{{ $rental->longitude ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.description') }}</dt>
                                            <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $rental->description ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.image') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($rental->image)
                                                    <div class="d-flex flex-column align-items-start gap-2">
                                                        <img src="{{ asset('storage/'.$rental->image) }}" alt="{{ $rental->name }}" class="img-thumbnail" style="max-height: 160px;">
                                                        <a href="{{ route('rentals.image', $rental) }}" class="btn btn-sm btn-primary">{{ __('common.download_image') }}</a>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9">{{ jalali_date($rental->created_at, 'Y/m/d H:i') ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.creator') }}</dt>
                                            <dd class="col-sm-9 mb-0">{{ trim(($rental->user?->name ?? '').' '.($rental->user?->last_name ?? '')) ?: '—' }}</dd>
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
