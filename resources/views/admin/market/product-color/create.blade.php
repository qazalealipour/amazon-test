@extends('admin.layouts.app')

@section('title', 'افزودن رنگ کالا')

@push('head-tag')
    <script src="{{ asset('admin-assets/ckeditor/build/ckeditor.js') }}"></script>
@endpush

@section('page-title', 'افزودن برند')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">ویترین</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">کالاها</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">رنگ های کالا</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">افزودن رنگ کالا</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات رنگ کالا</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.market.products.colors.index', [$product->id]) }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form" action="{{ route('admin.market.products.colors.store', [$product->id]) }}" method="post">
            @csrf
            <div class="card-body p-9">
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">نام رنگ</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="color_name" value="{{ old('color_name') }}" />
                        @error('color_name')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">رنگ</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="color" class="form-control form-control-solid" name="color" value="{{ old('color') }}" />
                        @error('color')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">میزان افزایش قیمت</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="number" class="form-control form-control-solid" name="price_increase" value="{{ old('price_increase') }}" />
                        @error('price_increase')
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