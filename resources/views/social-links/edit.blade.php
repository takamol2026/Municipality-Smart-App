@extends('layouts.main')

@section('title', __('social_links.edit'))
@section('page-title', __('social_links.edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('social-links.index') }}">{{ __('social_links.title') }}</a></li>
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
                    <form action="{{ route('social-links.update', $link) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                @include('social-links.partials.fields')

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.edit') }}</button>
                                            <a href="{{ route('social-links.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
