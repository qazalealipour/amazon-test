@extends('admin.layouts.app')

@section('title', 'افزودن سطح دسترسی ادمین')

@section('page-title', 'افزودن سطح دسترسی ادمین')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">کاربران ادمین</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">افزودن سطح دسترسی ادمین</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات سطح دسترسی ادمین</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.users.admin-users.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form" action="{{ route('admin.users.admin-users.permissions-store', $admin) }}" method="post">
            @csrf
            <div class="card-body p-9">
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">سطح دسترسی ها</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <select class="form-control form-control-solid" name="permissions[]" id="permissions" multiple tabindex="-1" aria-hidden="true">
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}" @foreach ($admin->permissions as $admin_permission)
                                    @selected($admin_permission->id == $permission->id)
                                @endforeach>{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @error('permissions')
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
    var roles = $('#permissions');
    roles.select2({
        placeholder: 'لطفا سطح دسترسی ها را وارد نمایید',
        multiple: true,
        tags : true
    })
</script>
@endpush
