@extends('admin.layouts.app')

@section('title', 'سفارشات')

@section('page-title', 'سفارشات')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">سفارشات</li>
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
                        class="form-control form-control-solid w-250px ps-14" placeholder="جستجو " />
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_ecommerce_category_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                        <thead>
                            <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-100px">شناسه</th>
                                <th class="min-w-150px">کد سفارش</th>
                                <th class="min-w-200px">مجموع مبلغ سفارش (بدون تخفیف)</th>
                                <th class="min-w-200px">مجموع تمامی مبالغ تخفیف</th>
                                <th class="min-w-200px">مبلغ تخفیف همه محصولات</th>
                                <th class="min-w-175px">مبلغ نهایی</th>
                                <th class="min-w-175px">وضعیت پرداخت</th>
                                <th class="min-w-175px">شیوه پرداخت</th>
                                <th class="min-w-150px">بانک</th>
                                <th class="min-w-175px">وضعیت ارسال</th>
                                <th class="min-w-175px">شیوه ارسال</th>
                                <th class="min-w-175px">وضعیت سفارش</th>
                                <th class="min-w-175px">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600 text-center">
                            @foreach ($orders as $order)
                                <tr>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $order->id }}</span>
                                    </td>
                                    <td>{{ number_format($order->order_final_amount) }} تومان</td>
                                    <td>{{ number_format($order->order_discount_amount) }} تومان</td>
                                    <td>{{ number_format($order->order_total_products_discount_amount) }} تومان</td>                                    
                                    <td>{{ number_format($order->order_final_amount - $order->order_discount_amount) }} تومان</td>                                    
                                    <td>
                                        @if ($order->payment_status == 0)
                                            <span class="badge badge-light-danger fw-bolder">پرداخت نشده</span>
                                        @elseif ($order->payment_status == 1)
                                            <span class="badge badge-light-success fw-bolder">پرداخت شده</span>
                                        @elseif ($order->payment_status == 2)
                                            <span class="badge badge-light-warning fw-bolder">باطل شده</span>
                                        @else
                                            <span class="badge badge-light-info fw-bolder">برگشت داده شده</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->payment_type == 0)
                                            <span class="badge badge-light-info fw-bolder">آنلاین</span>
                                        @elseif ($order->payment_type == 1)
                                            <span class="badge badge-light-info fw-bolder">آفلاین</span>
                                        @else
                                            <span class="badge badge-light-info fw-bolder">در محل</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>
                                    <td>
                                        @if ($order->delivery_status == 0)
                                            <span class="badge badge-light-danger fw-bolder">ارسال نشده</span>
                                        @elseif ($order->delivery_status == 1)
                                            <span class="badge badge-light-info fw-bolder">در حال ارسال</span>
                                        @elseif ($order->delivery_status == 2)
                                            <span class="badge badge-light-info fw-bolder">ارسال شده</span>
                                        @else
                                            <span class="badge badge-light-success fw-bolder">تحویل داده شده</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->delivery->name }}</td>
                                    <td>
                                        @if ($order->order_status == 0)
                                            <span class="badge badge-light-info fw-bolder">بررسی نشده</span>
                                        @elseif ($order->order_status == 1)
                                            <span class="badge badge-light-warning fw-bolder">در انتظار تایید</span>
                                        @elseif ($order->order_status == 2)
                                            <span class="badge badge-light-danger fw-bolder">تایید نشده</span>
                                        @elseif ($order->order_status == 3)
                                            <span class="badge badge-light-success fw-bolder">تایید شده</span>
                                        @elseif ($order->order_status == 4)
                                            <span class="badge badge-light-danger fw-bolder">باطل شده</span>
                                        @else
                                            <span class="badge badge-light-danger fw-bolder">مرجوع شده</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">عملیات
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.market.orders.show', [$order->id]) }}" class="menu-link px-3">مشاهده فاکتور</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.market.orders.change-send-status', [$order->id]) }}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">تغییر وضعیت ارسال</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.market.orders.change-order-status', [$order->id]) }}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">تغییر وضعیت سفارش</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.market.orders.cancel-order', [$order->id]) }}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">باطل کردن سفارش</a>
                                            </div>
                                        </div>
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
