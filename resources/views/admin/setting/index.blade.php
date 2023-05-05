@extends('admin.layouts.app')

@section('title', 'تنظیمات')

@section('page-title', 'تنظیمات')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">تنظیمات</li>
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
                                <th class="min-w-100px">لوگو</th>
                                <th class="min-w-100px">آیکون</th>
                                <th class="min-w-150px">عنوان سایت</th>
                                <th class="min-w-325px">توضیحات</th>
                                <th class="min-w-325px">کلمات کلیدی</th>
                                <th class="min-w-100px">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600 text-center">
                            <tr>
                                <td>
                                    <span class="text-gray-800 text-hover-primary fs-5 fw-bold">1</span>
                                </td>
                                <td>
                                    <div class="symbol symbol-50px">
                                        @if ($setting->logo === null)
                                            <span class="symbol-label bg-light-warning text-warning fw-bold">{{ Illuminate\Support\Str::substr($setting->title, 0, 1) }}</span>
                                        @else
                                            <img src="{{ asset($setting->logo) }}" class="symbol-label">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="symbol symbol-50px">
                                        @if ($setting->icon === null)
                                            <span class="symbol-label bg-light-warning text-warning fw-bold">{{ Illuminate\Support\Str::substr($setting->title, 0, 1) }}</span>
                                        @else
                                            <img src="{{ asset($setting->icon) }}" class="symbol-label">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $setting->title }}</span>
                                </td>
                                <td>{{ $setting->description }}</td>
                                <td>{{ $setting->keywords }}</td>
                                <td>
                                    <a href="{{ route('admin.setting.edit', [$setting->id]) }}" class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3 m-3">
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title=""
                                            data-bs-original-title="ویرایش">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
