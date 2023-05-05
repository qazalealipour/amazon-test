@extends('admin.layouts.app')

@section('title', 'ویرایش تنظیمات')

@section('page-title', 'ویرایش تنظیمات')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">تنظیمات</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">ویرایش تنظیمات</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات تنظیمات</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.setting.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.setting.update', [$setting->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body p-9">
                <div class="row mb-12">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">لوگو</div>
                    </div>
                    <div class="col-lg-8">
                        @if ($setting->logo === null)
                        <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/files/blank-image.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""data-bs-original-title="آپلود لوگو">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="logo">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف لوگو">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف لوگو">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @else
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/files/blank-image.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px bgi-position-center" style="background-size: 100%; background-image: url({{ asset(Illuminate\Support\Str::replace('\\', '/', $setting->logo)) }})"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تعویض لوگو">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="logo_path">
                                <input type="hidden" name="logo_remove">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف لوگو">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف لوگو">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @endif
                        @error('logo')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">آیکون</div>
                    </div>
                    <div class="col-lg-8">
                        @if ($setting->icon === null)
                        <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/files/blank-image.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""data-bs-original-title="آپلود آیکون">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="icon">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف آیکون">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف آیکون">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @else
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/files/blank-image.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px bgi-position-center" style="background-size: 100%; background-image: url({{ asset(Illuminate\Support\Str::replace('\\', '/', $setting->icon)) }})"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تعویض آیکون">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="icon">
                                <input type="hidden" name="icon_remove">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف آیکون">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف آیکون">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @endif
                        @error('icon')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">عنوان سایت</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $setting->title) }}" />
                        @error('title')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">کلمات کلیدی</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <textarea name="keywords" class="form-control form-control-solid h-100px">{{ old('keywords', $setting->keywords) }}</textarea>
                        @error('keywords')
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
                        <textarea name="description" class="form-control form-control-solid h-100px">{{ old('description', $setting->description) }}</textarea>
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
