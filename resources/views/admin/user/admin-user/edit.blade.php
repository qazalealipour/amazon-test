@extends('admin.layouts.app')

@section('title', 'ویرایش کاربر ادمین')

@section('page-title', 'ویرایش کاربر ادمین')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">کاربران ادمین</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">ویرایش کاربر ادمین</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات کاربر ادمین</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.users.admin-users.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form" action="{{ route('admin.users.admin-users.update', [$admin->id]) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <div class="card-body p-9">
                <div class="row mb-5">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">آواتار</div>
                    </div>
                    <div class="col-lg-8">
                        @if ($admin->profile_photo_path === null)
                        <div class="image-input image-input-empty image-input-circle mb-3" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/avatars/blank.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""data-bs-original-title="آپلود آواتار">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="profile_photo_path">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف آواتار">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف آواتار">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @else
                        <div class="image-input image-input-circle" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/avatars/blank.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px bgi-position-center" style="background-size: 100%; background-image: url({{ asset(Illuminate\Support\Str::replace('\\', '/', $admin->profile_photo_path)) }})"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تعویض آواتار">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="profile_photo_path">
                                <input type="hidden" name="avatar_remove">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف آواتار">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف آواتار">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @endif
                        @error('profile_photo_path')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">نام</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="first_name" value="{{ old('first_name', $admin->first_name) }}" />
                        @error('first_name')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">نام خانوادگی</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="last_name" value="{{ old('last_name', $admin->last_name) }}" />
                        @error('last_name')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">وضعیت فعال سازی</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="w-100">
                            <select class="form-select form-select-solid" name="activation" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @selected(old('activation', $admin->activation) == 0)>غیر فعال</option>
                                <option value="1" @selected(old('activation', $admin->activation) == 1)>فعال</option>
                            </select>
                        </div>
                        @error('activation')
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
