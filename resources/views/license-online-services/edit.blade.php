@extends('layouts.main')

@section('title', __('license_online_services.edit'))
@section('page-title', __('license_online_services.edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('license-online-services.index') }}">{{ __('license_online_services.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('common.edit') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.edit_form') }}</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('license-online-services.update', $service) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('license-online-services.partials.fields', ['service' => $service, 'submitLabel' => __('common.edit')])
                    </form>

                    @foreach ($service->files as $file)
                        <form id="delete-license-file-{{ $file->id }}" action="{{ route('license-online-services.files.destroy', [$service, $file]) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
