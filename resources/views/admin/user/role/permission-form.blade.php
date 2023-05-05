@extends('admin.layouts.app')

@section('title', 'دسترسی ها')

@section('page-title', 'دسترسی ها')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">سطوح دسترسی</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">دسترسی ها</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">دسترسی های نقش {{ $role->name }}</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.users.roles.index', [$role->id]) }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form" action="{{ route('admin.users.roles.permission-update', [$role->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body p-9">
                <div class="row mb-8">
                    @php
                        $rolePermissionsArray = $role->permissions()->pluck('id')->toArray();
                    @endphp
                    @foreach ($permissions as $key => $permission)
                    <div class="col-xl-3 fv-row">
                        <div class="fv-row mb-7">
                            <label class="form-check form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permissions[]" id="{{ $permission->id }}" @checked(in_array($permission->id, $rolePermissionsArray))>
                                <span class="form-check-label" for="{{ $permission->id }}">{{ $permission->name }}</span>
                            </label>
                            @error('permissions.' . $key)
                                <div class="fv-plugins-message-container invalid-feedback">
                                    <div class="badge badge-light-danger">{{ $message }}</div>
                                </div>
                            @enderror
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">لغو</button>
                <button type="submit" class="btn btn-primary" id="kt_project_settings_submit">ذخیره</button>
            </div>
        </form>
    </div>
@endsection
