@extends('layouts.main')

@section('title', __('license_online_services.create'))
@section('page-title', __('license_online_services.create'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('license-online-services.index') }}">{{ __('license_online_services.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('common.add') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('common.create_form') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('license-online-services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('license-online-services.partials.fields', ['submitLabel' => __('common.save')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
