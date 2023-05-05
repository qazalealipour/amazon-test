@extends('admin.layouts.app')

@section('title', 'افزودن نقش ادمین')

@section('page-title', 'افزودن نقش ادمین')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">نقشان ادمین</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">افزودن نقش ادمین</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات نقش ادمین</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.users.admin-users.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form" action="{{ route('admin.users.admin-users.roles-store', $admin) }}" method="post">
            @csrf
            <div class="card-body p-9">
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">نقش ها</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <select class="form-control form-control-solid" name="roles[]" id="roles" multiple tabindex="-1" aria-hidden="true">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @foreach ($admin->roles as $admin_role)
                                    @selected($admin_role->id == $role->id)
                                @endforeach>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roles')
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
    var roles = $('#roles');
    roles.select2({
        placeholder: 'لطفا نقش ها را وارد نمایید',
        multiple: true,
        tags : true
    })
</script>
@endpush
