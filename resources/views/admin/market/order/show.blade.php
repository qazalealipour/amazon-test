@extends('admin.layouts.app')

@section('title', 'مشاهده فاکتور')

@section('page-title', 'مشاهده فاکتور')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">سفارشات</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">مشاهده فاکتور</li>
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
                <a href="{{ route('admin.market.orders.all', [$order->id]) }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_ecommerce_category_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="printable">
                        <thead>
                            <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-300px"></th>
                                <th class="min-w-500px"></th>
                                <th>
                                    <button class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3" id="print">
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="چاپ">
                                            <i class="bi bi-printer fs-4"></i>
                                        </span>
                                    </button>
                                    <a href="{{ route('admin.market.orders.detail', [$order->id]) }}" class="btn btn-icon btn-bg-light btn-active-light-primary w-30px h-30px me-3">
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="جزئیات">
                                            <i class="bi bi-book fs-4"></i>
                                        </span>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            <tr>
                                <td>نام مشتری</td>
                                <td>{{ $order->user->full_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>شهر</td>
                                <td>{{ $order->address->city->name }}</td>
                            </tr>
                            <tr>
                                <td>آدرس</td>
                                <td>{{ $order->address->address . ' - پلاک ' . $order->address->no . ' - واحد ' . $order->address->unit }}</td>
                            </tr>
                            <tr>
                                <td>کد پستی</td>
                                <td>{{ $order->address->postal_code }}</td>
                            </tr>
                            <tr>
                                <td>گیرنده</td>
                                <td>{{ $order->address->recipient_first_name . ' ' . $order->address->recipient_last_name }}</td>
                            </tr>
                            <tr>
                                <td>موبایل</td>
                                <td>{{ $order->address->mobile }}</td>
                            </tr>
                            <tr>
                                <td>نوع پرداخت</td>
                                <td>
                                    @if($order->payment_type == 0) آنلاین  @elseif ($order->payment_type == 1) آفلاین @else در محل @endif
                                </td>
                            </tr>
                            <tr>
                                <td>وضعیت پرداخت</td>
                                <td>
                                    @if($order->payment_status == 0) پرداخت نشده  @elseif ($order->payment_status == 1) پرداخت شده @elseif ($order->payment_status == 2) باطل شده @else برگشت داده شده @endif
                                </td>
                            </tr>
                            <tr>
                                <td>هزینه ارسال</td>
                                <td>{{ number_format($order->delivery_amount) . ' تومان' ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>وضعیت ارسال</td>
                                <td>
                                    @if($order->delivery_status == 0) ارسال نشده  @elseif ($order->delivery_status == 1) درحال ارسال @elseif ($order->delivery_status == 2)  ارسال شده @else تحویل شده @endif
                                </td>
                            </tr>
                            <tr>
                                <td>تاریخ ارسال</td>
                                <td>{{ jalaliDate($order->delivery_date, '%A, %d %B %Y') }}</td>
                            </tr>
                            <tr>
                                <td>مجموع مبلغ سفارش (بدون تخفیف)</td>
                                <td>{{ number_format($order->order_final_amount) . ' تومان' ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>مجموع تمامی مبلغ تخفیفات</td>
                                <td>{{ number_format($order->order_discount_amount) . ' تومان' ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>مبلغ تخفیف همه محصولات</td>
                                <td>{{ number_format($order->order_total_products_discount_amount) . ' تومان' ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>مبلغ نهایی</td>
                                <td>{{ number_format($order->order_final_amount - $order->order_discount_amount) }} تومان</td>
                            </tr>
                            <tr>
                                <td>بانک</td>
                                <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>کوپن استفاده شده</td>
                                <td>{{ $order->coupon->code ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>مبلغ تخفیف کوپن</td>
                                <td>{{ number_format($order->order_coupon_discount_amount) . ' تومان' ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>تخفیف عمومی استفاده شده</td>
                                <td>{{ $order->commonDiscount->title ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>مبلغ تخفیف عمومی</td>
                                <td>{{ number_format($order->order_common_discount_amount) . ' تومان' ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>وضعیت سفارش</td>
                                <td>@if($order->order_status == 1) در انتظار تایید  @elseif ($order->order_status == 2)  تایید نشده @elseif ($order->order_status == 3) تایید شده @elseif ($order->order_status == 4) باطل شده @elseif($order->order_status == 5) مرجوع شده @else بررسی نشده @endif</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var printBtn = document.getElementById('print');
        printBtn.addEventListener('click', function(){
            printContent('printable');
        })
        function printContent(el){
            var restorePage = $('body').html();
            var printContent = $('#' + el).clone();
            $('body').empty().html(printContent);
            window.print();
            $('body').html(restorePage);
        }
    </script>
@endpush