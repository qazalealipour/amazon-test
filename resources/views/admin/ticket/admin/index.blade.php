@extends('admin.layouts.app')

@section('title', 'لیست ادمین تیکت ها')

@section('page-title', 'لیست ادمین تیکت ها')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">ادمین تیکت ها</li>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" data-kt-ecommerce-order-filter="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="جستجو" />
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_ecommerce_category_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                        <thead>
                            <tr class="text-center text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px">شناسه</th>
                                <th class="min-w-400px text-xl-start">ادمین</th>
                                <th class="min-w-175px">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600 text-center">
                            @foreach ($ticketAdmins as $key => $admin)
                                <tr>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ ++$key }}</span>
                                    </td>
                                    <td class="d-flex align-items-center text-start">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            @if ($admin->profile_photo_path === null)
                                                <span>
                                                    <div class="symbol-label fs-3 bg-light-primary text-primary">{{ Illuminate\Support\Str::substr($admin->first_name, 0, 1) }}</div>
                                                </span>
                                            @else
                                                <span>
                                                    <div class="symbol-label">
                                                        <img src="{{ asset($admin->profile_photo_path) }}" class="w-100">
                                                    </div>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 text-hover-primary mb-1">{{ $admin->full_name }}</span>
                                            <span>{{ $admin->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tickets.admins.set', [$admin->id]) }}" class="btn btn-light btn-active-light-primary btn-sm">
                                        {{ $admin->ticketAdmin == null ? 'اضافه' : 'حذف' }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        <div class="dataTables_paginate paging_simple_numbers" id="kt_ecommerce_category_table_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="kt_ecommerce_category_table_previous">
                                    <a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="0" tabindex="0" class="page-link"><i class="previous"></i></a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                </li>
                                <li class="paginate_button page-item next" id="kt_ecommerce_category_table_next">
                                    <a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="3" tabindex="0" class="page-link"><i class="next"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        function changeStatus(id) {
            var element = $("#status-" + id);
            var url = element.attr('data-url');
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToastr('مشتری با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            successToastr('مشتری با موفقیت غیر فعال شد');
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
    <script type="text/javascript">
        function changeActivation(id) {
            var element = $("#activation-" + id);
            var url = element.attr('data-url');
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.activation) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToastr('فعال سازی مشتری با موفقیت انجام شد');
                        } else {
                            element.prop('checked', false);
                            successToastr('غیرفعال سازی مشتری با موفقیت انجام شد');
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