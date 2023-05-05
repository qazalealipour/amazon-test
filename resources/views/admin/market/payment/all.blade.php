@extends('admin.layouts.app')

@section('title', 'پرداخت ها')

@section('page-title', 'پرداخت ها')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">پرداخت ها</li>
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
                                <th class="min-w-150px">کد تراکنش</th>
                                <th class="min-w-150px">مبلغ</th>
                                <th class="min-w-150px">پرداخت کننده</th>
                                <th class="min-w-100px">بانک</th>
                                <th class="min-w-150px">وضعیت پرداخت</th>
                                <th class="min-w-150px">نوع پرداخت</th>
                                <th class="min-w-175px">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600 text-center">
                            @foreach ($payments as $payment)
                                <tr>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $payment->paymentable->transaction_id ?? '-' }}</span>
                                    </td>
                                    <td>{{ number_format($payment->amount) }} تومان</td>
                                    <td>{{ $payment->user->full_name }}</td>
                                    <td>{{ $payment->paymentable->gateway ?? '-' }}</td>
                                    <td>
                                        @if ($payment->status == 0)
                                            <span class="badge badge-light-danger fw-bolder">پرداخت نشده</span>
                                        @elseif ($payment->status == 1)
                                            <span class="badge badge-light-success fw-bolder">پرداخت شده</span>
                                        @elseif ($payment->status == 2)
                                            <span class="badge badge-light-warning fw-bolder">باطل شده</span>
                                        @else
                                            <span class="badge badge-light-info fw-bolder">برگشت داده شده</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->type == 0)
                                            <span class="badge badge-light-info fw-bolder">آنلاین</span>
                                        @elseif ($payment->type == 1)
                                            <span class="badge badge-light-info fw-bolder">آفلاین</span>
                                        @else
                                            <span class="badge badge-light-info fw-bolder">در محل</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.market.payments.show', $payment->id) }}" class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="مشاهده">
                                                <i class="bi bi-eye-fill fs-4"></i>
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.market.payments.canceled', $payment->id) }}" class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="باطل کردن">
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                        <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.market.payments.returned', $payment->id) }}" class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="بازگرداندن">
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14 6H9.60001V8H14C15.1 8 16 8.9 16 10V21C16 21.6 16.4 22 17 22C17.6 22 18 21.6 18 21V10C18 7.8 16.2 6 14 6Z" fill="currentColor"/>
                                                        <path opacity="0.3" d="M9.60002 12L5.3 7.70001C4.9 7.30001 4.9 6.69999 5.3 6.29999L9.60002 2V12Z" fill="currentColor"/>
                                                    </svg>
                                                </span>
                                            </span>
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
