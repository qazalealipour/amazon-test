@extends('admin.layouts.app')

@section('title', 'افزودن دسترسی')

@section('page-title', 'افزودن دسترسی')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">سطوح دسترسی</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">افزودن دسترسی</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات دسترسی</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.users.permissions.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form" action="{{ route('admin.users.permissions.store') }}" method="post">
            @csrf
            <div class="card-body p-9">
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">عنوان دسترسی</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="name" value="{{ old('name') }}" />
                        @error('name')
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
                                <option value="0" @selected(old('status') == 0)>غیر فعال</option>
                                <option value="1" @selected(old('status') == 1)>فعال</option>
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
                        <textarea name="description" class="form-control form-control-solid h-100px">{{ old('description') }}</textarea>
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
