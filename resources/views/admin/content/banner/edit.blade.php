@extends('admin.layouts.app')

@section('title', 'ویرایش بنر')

@section('page-title', 'ویرایش بنر')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">بنرها</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">ویرایش بنر</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات بنر</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.content.banners.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.content.banners.update', [$banner->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body p-9">
                <div class="row mb-5">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">تصویر</div>
                    </div>
                    <div class="col-lg-8">
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/files/blank-image.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px bgi-position-center" style="background-size: 100%; background-image: url({{ asset(Illuminate\Support\Str::replace('\\', '/', $banner->image)) }})"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تعویض تصویر">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="image">
                                <input type="hidden" name="image_remove">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف تصویر">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف تصویر">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @error('image')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">عنوان بنر</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $banner->title) }}" />
                        @error('title')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">آدرس URL</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="url" value="{{ old('url', $banner->url) }}" />
                        @error('url')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">مکان</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="w-100">
                            <select class="form-select form-select-solid" name="position" data-control="select2"
                                data-hide-search="true">
                                @foreach ($positions as $key => $position)
                                    <option value="{{ $key }}" @selected(old('position', $banner->position) == $key)>{{ $position }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('position')
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
                                <option value="0" @selected(old('status', $banner->status) == 0)>غیر فعال</option>
                                <option value="1" @selected(old('status', $banner->status) == 1)>فعال</option>
                            </select>
                        </div>
                        @error('status')
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


