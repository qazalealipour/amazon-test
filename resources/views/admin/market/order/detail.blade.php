@extends('admin.layouts.app')

@section('title', 'جزئیات سفارش')

@section('page-title', 'جزئیات سفارش')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">سفارشات</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">جزئیات سفارش</li>
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
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.market.orders.show', [$order->id]) }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_ecommerce_category_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                        <thead>
                            <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-100px">شناسه</th>
                                <th class="min-w-300px">نام محصول</th>
                                <th class="min-w-175px">درصد فروش فوق العاده</th>
                                <th class="min-w-150px">مبلغ فروش فوق العاده</th>
                                <th class="min-w-100px">تعداد</th>
                                <th class="min-w-150px">جمع قیمت محصول</th>
                                <th class="min-w-150px">مبلغ نهایی</th>
                                <th class="min-w-100px">رنگ</th>
                                <th class="min-w-100px">گارانتی</th>
                                <th class="min-w-175px">ویژگی ها</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600 text-center">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->amazingSale->percentage . '%' ?? '-' }}</td>
                                    <td>{{ number_format($item->order_amazing_sale_discount_amount) . ' تومان' ?? '-' }}</td>
                                    <td>{{ $item->number }}</td>
                                    <td>{{ number_format($item->final_product_price) . ' تومان' ?? '-' }}</td>
                                    <td>{{ number_format($item->final_total_price) . ' تومان' ?? '-' }}</td>
                                    <td>{{ $item->color->color_name ?? '-' }}</td>
                                    <td>{{ $item->guarantee->name ?? '-' }}</td>
                                    <td>
                                        @forelse ($item->orderItemAttributes as $attribute)
                                        <span class="badge badge-light fw-bolder">{{ $attribute->categoryAttribute->name ?? '-' }} : {{ json_decode($attribute->categoryValue->value)->value ?? '-' }}</span>
                                        @empty
                                            -
                                        @endforelse
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
