@extends('layouts.main')

@section('title', __('users.list'))
@section('page-title', __('users.list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('users.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.search') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.index') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="name" class="form-label">{{ __('common.name') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('users.name_placeholder') }}">
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
                                            <a href="{{ route('users.index') }}" class="btn btn-light">{{ __('common.clear') }}</a>
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
                    <h5 class="card-title mb-0">{{ __('users.title') }}</h5>
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i> {{ __('users.create') }}
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('common.name') }}</th>
                                    <th>{{ __('users.username') }}</th>
                                    <th>{{ __('common.email') }}</th>
                                    <th>{{ __('common.phone') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                    <th>{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $users->firstItem() + $loop->index }}</td>
                                        <td>{{ trim($user->name.' '.$user->last_name) }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?: '—' }}</td>
                                        <td>
                                            @if ($user->status === \App\Enums\RecordStatus::Active)
                                                <span class="badge bg-success-subtle text-success">{{ __('common.active') }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">{{ __('common.inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ jalali_date($user->created_at) }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}">{{ __('common.show') }}</button>
                                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">{{ __('common.edit') }}</a>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm(@json(__('users.delete_confirm')))">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('common.delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">{{ __('common.empty') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($users->hasPages())
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    @endif

                    @foreach ($users as $user)
                        <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userModalLabel{{ $user->id }}">{{ __('common.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('common.close') }}"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">{{ __('common.name') }}</dt>
                                            <dd class="col-sm-9">{{ $user->name }}</dd>

                                            <dt class="col-sm-3">{{ __('users.last_name') }}</dt>
                                            <dd class="col-sm-9">{{ $user->last_name ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('users.username') }}</dt>
                                            <dd class="col-sm-9">{{ $user->username ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.email') }}</dt>
                                            <dd class="col-sm-9">{{ $user->email }}</dd>

                                            <dt class="col-sm-3">{{ __('common.phone') }}</dt>
                                            <dd class="col-sm-9">{{ $user->phone ?: '—' }}</dd>

                                            <dt class="col-sm-3">{{ __('common.status') }}</dt>
                                            <dd class="col-sm-9">
                                                @if ($user->status === \App\Enums\RecordStatus::Active)
                                                    {{ __('common.active') }}
                                                @else
                                                    {{ __('common.inactive') }}
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">{{ __('common.created_at') }}</dt>
                                            <dd class="col-sm-9 mb-0">{{ jalali_date($user->created_at, 'Y/m/d H:i') ?: '—' }}</dd>
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
