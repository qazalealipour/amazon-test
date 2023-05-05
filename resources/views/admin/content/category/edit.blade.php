@extends('admin.layouts.app')

@section('title', 'ویرایش دسته بندی')

@push('head-tag')
    <script src="{{ asset('admin-assets/ckeditor/build/ckeditor.js') }}"></script>
@endpush

@section('page-title', 'ویرایش دسته بندی')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">دسته بندی ها</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">ویرایش دسته بندی</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات دسته بندی</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.content.categories.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form" action="{{ route('admin.content.categories.update', [$postCategory->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body p-9">
                <div class="row mb-5">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">تصویر دسته بندی</div>
                    </div>
                    <div class="col-lg-8">
                        @if ($postCategory->image_path === null)
                        <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/files/blank-image.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""data-bs-original-title="آپلود تصویر">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="image_path">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف تصویر">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف تصویر">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @else
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/files/blank-image.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px bgi-position-center" style="background-size: 100%; background-image: url({{ asset(Illuminate\Support\Str::replace('\\', '/', $postCategory->image_path['indexArray']['medium'])) }})"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تعویض تصویر">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="image_path">
                                <input type="hidden" name="image_remove">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف تصویر">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف تصویر">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @endif
                        @error('image_path')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">نام دسته بندی</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="name" value="{{ old('name', $postCategory->name) }}"  />
                        @error('name')
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
                        <input type="hidden" id="tags" class="form-control form-control-solid" name="tags" value="{{ old('tags', $postCategory->tags) }}" />
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
                            <select class="form-select form-select-solid" name="status" data-control="select2" data-hide-search="true">
                                <option value="0" @selected(old('status', $postCategory->status) == 0)>غیر فعال</option>
                                <option value="1" @selected(old('status', $postCategory->status) == 1)>فعال</option>
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
                        <div class="fs-6 fw-bold mt-2 mb-3">توضیحات</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <textarea name="description" id="editor" class="form-control form-control-solid h-100px">{{ old('description', $postCategory->description) }}</textarea>
                        @error('description')
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
        $(document).ready(function (){
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var tags_input_value = tags_input.val();
            var default_data = null;

            if (tags_input_value !== null && tags_input_value.length > 0){
                default_data = tags_input_value.split(',');
            }

            select_tags.select2({
                tags: true,
                data: default_data
            });

            select_tags.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function (event){
                if (select_tags.val() !== null && select_tags.val().length > 0){
                    var selectSource = select_tags.val().join(',');
                    tags_input.val(selectSource);
                }
            });
        });
    </script>
@endpush