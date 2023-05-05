@extends('admin.layouts.app')

@section('title', 'ویرایش پیج')

@push('head-tag')
    <script src="{{ asset('admin-assets/ckeditor/build/ckeditor.js') }}"></script>
@endpush

@section('page-title', 'ویرایش پیج')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">پیج ساز</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">ویرایش پیج</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات پیج</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.content.pages.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.content.pages.update', [$page->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body p-9">
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">عنوان</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $page->title) }}" />
                        @error('title')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">برچسب ها</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="hidden" id="tags" class="form-control form-control-solid" name="tags" value="{{ old('tags', $page->tags) }}" />
                        <select class="form-control form-control-solid select2" id="select_tags" multiple tabindex="-1" aria-hidden="true"></select>
                        @error('tags')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">وضعیت</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="w-100">
                            <select class="form-select form-select-solid" name="status" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @selected(old('status', $page->status) == 0)>غیر فعال</option>
                                <option value="1" @selected(old('status', $page->status) == 1)>فعال</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">محتوای پیج</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <textarea name="body" id="editor" class="form-control form-control-solid h-100px">{{ old('body', $page->body) }}</textarea>
                        @error('body')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">لغو</button>
                <button type="submit" class="btn btn-primary" id="kt_project_settings_submit">ذخیره</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $(document).ready(function() {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var tags_input_value = tags_input.val();
            var default_data = null;

            if (tags_input_value !== null && tags_input_value.length > 0) {
                default_data = tags_input_value.split(',');
            }

            select_tags.select2({
                tags: true,
                data: default_data
            });

            select_tags.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function(event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectSource = select_tags.val().join(',');
                    tags_input.val(selectSource);
                }
            });
        });
    </script>
@endpush
