@extends('admin.layouts.app')

@section('title', 'لیست گارانتی های کالا')

@section('page-title', 'لیست گارانتی های کالا')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">ویترین</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">کالاها</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">گارانتی</li>
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
                <a href="{{ route('admin.market.products.guarantees.create', [$product->id]) }}" class="btn btn-primary">افزودن گارانتی کالا</a>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_ecommerce_category_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                        <thead>
                            <tr class="text-center text-gray-400 fw-bolder fs-6 text-uppercase gs-0">
                                <th class="min-w-100px">شناسه</th>
                                <th class="min-w-150px">عنوان گارانتی</th>
                                <th class="min-w-200px">میزان افزایش قیمت</th>
                                <th class="min-w-200px">نام کالا</th>
                                <th class="min-w-100px">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600 text-center">
                            @foreach ($product->guarantees as $guarantee)
                                <tr>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <span class="text-gray-800 text-hover-primary fw-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-hover-primary text-gray-800">{{ $guarantee->name }}</span>
                                    </td>
                                    <td>{{ number_format($guarantee->price_increase) }} تومان</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.market.products.guarantees.destroy', ['product' => $product->id, 'guarantee' => $guarantee->id]) }}" method="post" class="d-inline">
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
    @include('admin.alerts.sweetalert.delete-confirm')
@endpush
