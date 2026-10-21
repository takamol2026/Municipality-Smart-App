@extends('layouts.main')

@section('title', __('projects.edit'))
@section('page-title', __('projects.edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.title') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">{{ __('projects.title') }}</a></li>
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
                    <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="title" class="form-label">{{ __('projects.title_label') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $project->title) }}" placeholder="{{ __('projects.title_placeholder') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="project_category_id" class="form-label">{{ __('common.category') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <select name="project_category_id" id="project_category_id" class="form-select @error('project_category_id') is-invalid @enderror" required>
                                            <option value="">{{ __('common.category_select') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('project_category_id', $project->project_category_id) == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('project_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="slug" class="form-label">{{ __('common.slug') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $project->slug) }}" placeholder="{{ __('common.slug_placeholder') }}">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="location" class="form-label">{{ __('projects.location') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $project->location) }}" placeholder="{{ __('projects.location_placeholder') }}">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('projects.dates') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="text" name="start_date" id="start_date" data-jdp data-jdp-only-date aria-label="{{ __('projects.start_date') }}" placeholder="{{ __('projects.start_date') }}" class="form-control @error('start_date') is-invalid @enderror" value="{{ \App\Models\Project::toJalaliDate(old('start_date', $project->start_date)) }}" autocomplete="off">
                                                @error('start_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="end_date" id="end_date" data-jdp data-jdp-only-date aria-label="{{ __('projects.end_date') }}" placeholder="{{ __('projects.end_date') }}" class="form-control @error('end_date') is-invalid @enderror" value="{{ \App\Models\Project::toJalaliDate(old('end_date', $project->end_date)) }}" autocomplete="off">
                                                @error('end_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('common.status') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="active" @checked(old('status', $project->status->value) === 'active')>
                                            <label class="form-check-label" for="status_active">{{ __('common.active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_inactive" value="inactive" @checked(old('status', $project->status->value) === 'inactive')>
                                            <label class="form-check-label" for="status_inactive">{{ __('common.inactive') }}</label>
                                        </div>
                                        @error('status')
                                            <div class="text-danger small d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="sort_order" class="form-label">{{ __('common.sort_order') }}</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $project->sort_order) }}" min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('projects.publish') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-check form-check-inline form-radio-warning">
                                            <input class="form-check-input @error('status_publish') is-invalid @enderror" type="radio" name="status_publish" id="status_in_progress" value="in_progress" @checked(old('status_publish', $project->status_publish->value) === 'in_progress')>
                                            <label class="form-check-label" for="status_in_progress">{{ __('projects.in_progress') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input @error('status_publish') is-invalid @enderror" type="radio" name="status_publish" id="status_completed" value="completed" @checked(old('status_publish', $project->status_publish->value) === 'completed')>
                                            <label class="form-check-label" for="status_completed">{{ __('projects.completed') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-secondary">
                                            <input class="form-check-input @error('status_publish') is-invalid @enderror" type="radio" name="status_publish" id="status_not_started" value="not_started" @checked(old('status_publish', $project->status_publish->value) === 'not_started')>
                                            <label class="form-check-label" for="status_not_started">{{ __('projects.not_started') }}</label>
                                        </div>
                                        @error('status_publish')
                                            <div class="text-danger small d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="short_description" class="form-label">{{ __('common.short_description') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="short_description" id="short_description" rows="2" class="form-control @error('short_description') is-invalid @enderror" placeholder="{{ __('common.short_description_placeholder') }}">{{ old('short_description', $project->short_description) }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="description" class="form-label">{{ __('common.description') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('common.description_placeholder') }}">{{ old('description', $project->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="benefits" class="form-label">{{ __('projects.benefits') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <textarea name="benefits" id="benefits" rows="3" class="form-control @error('benefits') is-invalid @enderror" placeholder="{{ __('projects.benefits_placeholder') }}">{{ old('benefits', $project->benefits) }}</textarea>
                                        @error('benefits')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label for="image" class="form-label">{{ __('common.image') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($project->image)
                                            <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" class="img-thumbnail mt-2" style="max-height: 120px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">{{ __('common.media') }}</label>
                                    </div>
                                    <div class="col-lg-10">
                                        @foreach ($project->media as $media)
                                            <div class="border rounded p-3 mb-3">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-md-3">
                                                        @if ($media->previewPath())
                                                            <img src="{{ asset('storage/'.$media->previewPath()) }}" alt="{{ $media->title ?: $project->title }}" class="img-thumbnail" style="max-height: 90px;">
                                                        @elseif ($media->isVideoFile())
                                                            <span class="badge bg-info-subtle text-info">{{ __('common.video') }}</span>
                                                        @else
                                                            <span class="badge bg-secondary-subtle text-secondary">{{ $media->typeLabel() }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">{{ __('common.media_title') }}</label>
                                                        <input type="text" name="existing_media[{{ $media->id }}][title]" class="form-control" value="{{ old('existing_media.'.$media->id.'.title', $media->title) }}" placeholder="{{ __('common.media_title_placeholder') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">{{ __('common.type') }}</label>
                                                        <select name="existing_media[{{ $media->id }}][type]" class="form-select">
                                                            <option value="image" @selected(old('existing_media.'.$media->id.'.type', $media->type) === 'image')>{{ __('common.image') }}</option>
                                                            <option value="video" @selected(old('existing_media.'.$media->id.'.type', $media->type) === 'video')>{{ __('common.video') }}</option>
                                                            <option value="document" @selected(old('existing_media.'.$media->id.'.type', $media->type) === 'document')>{{ __('common.document') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">{{ __('common.order') }}</label>
                                                        <input type="number" name="existing_media[{{ $media->id }}][sort_order]" class="form-control" value="{{ old('existing_media.'.$media->id.'.sort_order', $media->sort_order) }}" min="0">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('common.replace_file') }}</label>
                                                        <input type="file" name="existing_media[{{ $media->id }}][file]" class="form-control @error('existing_media.'.$media->id.'.file') is-invalid @enderror">
                                                        @error('existing_media.'.$media->id.'.file')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">{{ __('common.replace_thumbnail') }}</label>
                                                        <input type="file" name="existing_media[{{ $media->id }}][thumbnail]" class="form-control @error('existing_media.'.$media->id.'.thumbnail') is-invalid @enderror" accept="image/*">
                                                        @error('existing_media.'.$media->id.'.thumbnail')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="d-flex flex-column gap-2">
                                                            @if ($media->file)
                                                                <a href="{{ route('projects.media.download', [$project, $media]) }}" class="btn btn-sm btn-primary">{{ __('common.download') }}</a>
                                                            @endif
                                                            <button type="submit" form="delete-project-media-{{ $media->id }}" class="btn btn-sm btn-danger" onclick="return confirm(@json(__('common.delete_media_confirm')))">{{ __('common.delete') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div id="project-media-rows">
                                            @foreach (old('media', []) as $index => $row)
                                                @include('projects.partials.media-row', ['index' => $index, 'row' => $row])
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light" id="add-project-media">{{ __('common.add_media') }}</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">{{ __('common.edit') }}</button>
                                            <a href="{{ route('projects.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>

                    @foreach ($project->media as $media)
                        <form id="delete-project-media-{{ $media->id }}" action="{{ route('projects.media.destroy', [$project, $media]) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach

                    <template id="project-media-row-template">
                        @include('projects.partials.media-row', ['index' => '__INDEX__', 'row' => ['title' => '', 'type' => 'image', 'sort_order' => 0]])
                    </template>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const rows = document.getElementById('project-media-rows');
            const addButton = document.getElementById('add-project-media');
            const template = document.getElementById('project-media-row-template');

            if (!rows || !addButton || !template) {
                return;
            }

            addButton.addEventListener('click', function () {
                const index = Date.now();
                const wrapper = document.createElement('div');
                wrapper.innerHTML = template.innerHTML.replaceAll('__INDEX__', String(index));
                rows.appendChild(wrapper.firstElementChild);
            });

            rows.addEventListener('click', function (event) {
                const button = event.target.closest('.remove-project-media');
                if (!button) {
                    return;
                }

                const row = button.closest('.project-media-row');
                if (row) {
                    row.remove();
                }
            });
        })();
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/assets/libs/jalalidatepicker/jalalidatepicker.min.css') }}">
@endpush

@push('scripts')
    @include('partials.jalali-datepicker')
@endpush
