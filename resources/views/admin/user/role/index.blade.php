@extends('admin.layouts.app')

@section('title', 'لیست نقش ها')

@section('page-title', 'لیست نقش ها')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">سطوح دسترسی</li>
@endpush

@section('content')
    <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            @includeWhen(session('alert-section-success'), 'admin.alerts.alert-section.success')
            @includeWhen(session('alert-section-error'), 'admin.alerts.alert-section.error')
            @includeWhen(session('alert-section-warning'), 'admin.alerts.alert-section.warning')
            @includeWhen(session('alert-section-info'), 'admin.alerts.alert-section.info')
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو " />
                </div>
            </div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.users.roles.create') }}" class="btn btn-primary">افزودن نقش</a>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_ecommerce_category_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                        <thead>
                            <tr class="text-center text-gray-400 fw-bolder fs-6 text-uppercase gs-0">
                                <th class="min-w-100px">شناسه</th>
                                <th class="min-w-175px">عنوان نقش</th>
                                <th class="min-w-300px">دسترسی ها</th>
                                <th class="min-w-325px">توضیحات</th>
                                <th class="min-w-100px">وضعیت</th>
                                <th class="min-w-175px">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600 text-center">
                            @foreach ($roles as $role)
                                <tr>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $role->name }}</span>
                                    </td>
                                    <td>
                                        @if (empty($role->permissions()->get()->toArray()))
                                            <div class="badge badge-light-danger fw-bolder">برای این دسترسی هیچ نقشی تعریف نشده است</div>
                                        @else
                                            <div class="d-flex flex-column text-gray-600">
                                                @foreach ($role->permissions as $permission)
                                                    <div class="d-flex align-items-center py-2">
                                                        <span class="bullet bg-primary me-3"></span>
                                                        {{ $permission->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        <div class="form-check form-check-solid form-switch ms-7">
                                            <input type="checkbox" name="status" id="{{ $role->id }}" class="form-check-input w-35px h-20px" onchange="changeStatus({{ $role->id }})" data-url="{{ route('admin.users.roles.change-status', [$role->id]) }}" @checked($role->status === 1)>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.roles.permission-form', [$role->id]) }}" class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="دسترسی ها">
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                                        <path d="M15.8054 11.639C15.6757 11.5093 15.5184 11.4445 15.3331 11.4445H15.111V10.1111C15.111 9.25927 14.8055 8.52784 14.1944 7.91672C13.5833 7.30557 12.8519 7 12 7C11.148 7 10.4165 7.30557 9.80547 7.9167C9.19432 8.52784 8.88885 9.25924 8.88885 10.1111V11.4445H8.66665C8.48153 11.4445 8.32408 11.5093 8.19444 11.639C8.0648 11.7685 8 11.926 8 12.1112V16.1113C8 16.2964 8.06482 16.4539 8.19444 16.5835C8.32408 16.7131 8.48153 16.7779 8.66665 16.7779H15.3333C15.5185 16.7779 15.6759 16.7131 15.8056 16.5835C15.9351 16.4539 16 16.2964 16 16.1113V12.1112C16.0001 11.926 15.9351 11.7686 15.8054 11.639ZM13.7777 11.4445H10.2222V10.1111C10.2222 9.6204 10.3958 9.20138 10.7431 8.85421C11.0903 8.507 11.5093 8.33343 12 8.33343C12.4909 8.33343 12.9097 8.50697 13.257 8.85421C13.6041 9.20135 13.7777 9.6204 13.7777 10.1111V11.4445Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.users.roles.edit', [$role->id]) }}" class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="ویرایش">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </a>
                                        <form action="{{ route('admin.users.roles.destroy', [$role->id]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3 delete" data-bs-toggle="tooltip" title="" data-kt-customer-payment-method="delete" data-bs-original-title="حذف">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        function changeStatus(id) {
            var element = $("#" + id);
            var url = element.attr('data-url');
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToastr('نقش با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            successToastr('نقش با موفقیت غیر فعال شد');
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToastr('هنگام ویرایش مشکلی پیش آمده است');
                    }
                },
                error: function() {
                    element.prop('checked', elementValue);
                    errorToastr('ارتباط برقرار نشد');
                }
            });

            function successToastr(message) {
                toastr.options = {
                    "closeButton": false,
                    "debug": true,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toastr-bottom-left",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.info(message);
            }

            function errorToastr(message) {
                toastr.options = {
                    "closeButton": false,
                    "debug": true,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toastr-bottom-left",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning(message);
            }
        }
    </script>
    @include('admin.alerts.sweetalert.delete-confirm')
@endpush
