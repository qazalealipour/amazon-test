@extends('admin.layouts.app')

@section('title', 'نمایش پرداخت')

@section('page-title', 'نمایش پرداخت')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">ویترین</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">پرداخت ها</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">نمایش پرداخت</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header align-items-center py-5 gap-5">
            <div class="d-flex"></div>
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.market.payments.all') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <h1 class="d-flex text-dark fw-bolder fs-2 align-items-center my-1">مشخصات پرداخت</h1>
                    <span class="badge badge-light-primary my-1 me-2">کد تراکنش : {{ $payment->paymentable->transaction_id ?? '-' }}</span>
                    <span class="badge badge-light-info my-1 me-2">تاریخ پرداخت : {{ jalaliDate($payment->paymentable->pay_date) ?? '-' }}</span>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <span class="fs-5 text-gray-600 fw-bold text-dark lh-base">{{ $payment->paymentable->title }}</span>
                </div>
            </div>
            <div data-kt-inbox-message="message_wrapper">
                <div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 me-4">
                            @if ($payment->user->profile_photo_path === null)
                                <span class="symbol-label bg-light-warning text-warning fw-bold">{{ Illuminate\Support\Str::substr($payment->user->full_name, 0, 1) }}</span>
                            @else
                                <img src="{{ asset($payment->user->profile_photo_path['indexArray']['small']) }}" class="symbol-label">
                            @endif
                        </div>
                        <div class="pe-5">
                            <div class="d-flex align-items-center flex-wrap gap-1">
                                <span class="fw-bolder text-dark text-hover-primary">{{ $payment->user->full_name}}</span>
                            </div>
                            <div data-kt-inbox-message="details">
                                <div class="fw-bolder badge badge-light-primary mt-3">شناسه پرداخت کننده : {{ $payment->user_id }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse fade show" data-kt-inbox-message="message">
                    <div class="py-9">
                        <p class="fw-bolder">مبلغ : {{ number_format($payment->paymentable->amount) }} تومان</p>
                        <p class="fw-bolder">درگاه : {{ $payment->paymentable->gateway ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
