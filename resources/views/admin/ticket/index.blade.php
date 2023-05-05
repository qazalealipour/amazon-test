@extends('admin.layouts.app')

@section('title', 'لیست تمام تیکت ها')

@section('page-title', 'لیست تمام تیکت ها')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">تمام تیکت ها</li>
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
                                <th class="min-w-200px">موضوع</th>
                                <th class="min-w-250px">توضیحات</th>
                                <th class="min-w-200px">نویسنده تیکت</th>
                                <th class="min-w-150px">دسته بندی</th>
                                <th class="min-w-150px">اولویت</th>
                                <th class="min-w-200px">ارجاع شده از</th>
                                <th class="min-w-200px">تیکت مرجع</th>
                                <th class="min-w-100px">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600 text-center">
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $ticket->subject }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="text-gray-800 text-hover-primary fw-bold">{{ Illuminate\Support\Str::limit($ticket->description, 60) }}</span>
                                    </td>
                                    <td>{{ $ticket->user->full_name }}</td>
                                    <td>{{ $ticket->category->name }}</td>
                                    <td>{{ $ticket->priority->name }}</td>
                                    <td>{{ $ticket->admin ? $ticket->admin->user->first_name . ' ' . $ticket->admin->user->last_name : 'نامشخص' }}
                                    </td>
                                    <td>{{ $ticket->ticket_id === null ? '-' : $ticket->parent->subject }}</td>
                                    <td>
                                        <a href="{{ route('admin.tickets.show', [$ticket->id]) }}"
                                            class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title=""
                                                data-bs-original-title="نمایش">
                                                <i class="bi bi-eye-fill fs-4"></i>
                                            </span>
                                        </a>
                                        @if ($ticket->status == 1)
                                            <a href="{{ route('admin.tickets.change', [$ticket->id]) }}"
                                                class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title=""
                                                    data-bs-original-title="باز کردن" aria-describedby="tooltip53561">
                                                    <span class="svg-icon svg-icon-1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="7.05025" y="15.5356"
                                                                width="12" height="2" rx="1"
                                                                transform="rotate(-45 7.05025 15.5356)" fill="currentColor">
                                                            </rect>
                                                            <rect x="8.46447" y="7.05029" width="12"
                                                                height="2" rx="1"
                                                                transform="rotate(45 8.46447 7.05029)" fill="currentColor">
                                                            </rect>
                                                        </svg>
                                                    </span>
                                                </span>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.tickets.change', [$ticket->id]) }}"
                                                class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title=""
                                                    data-bs-original-title="بستن">
                                                    <span class="svg-icon svg-icon-1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </span>
                                            </a>
                                        @endif
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
                                <li class="paginate_button page-item previous disabled"
                                    id="kt_ecommerce_category_table_previous">
                                    <a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="0"
                                        tabindex="0" class="page-link"><i class="previous"></i></a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="1"
                                        tabindex="0" class="page-link">1</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="2"
                                        tabindex="0" class="page-link">2</a>
                                </li>
                                <li class="paginate_button page-item next" id="kt_ecommerce_category_table_next">
                                    <a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="3"
                                        tabindex="0" class="page-link"><i class="next"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
