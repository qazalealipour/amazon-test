@extends('admin.layouts.app')

@section('title', 'نمایش تیکت')

@section('page-title', 'نمایش تیکت')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">تیکت ها</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">نمایش تیکت</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header align-items-center py-5 gap-5">
            <div class="d-flex"></div>
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.tickets.all') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <h1 class="d-flex text-dark fw-bolder fs-2 align-items-center my-1">مشخصات تیکت</h1>
                    <span class="badge badge-light-primary my-1 me-2"> شناسه تیکت : {{ $ticket->id }}</span>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <span class="fs-5 text-gray-600 fw-bold text-dark lh-base">{{ $ticket->subject }}</span>
                </div>
            </div>
            <div data-kt-inbox-message="message_wrapper">
                <div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 me-4">
                            @if ($ticket->user->profile_photo_path === null)
                                <span class="symbol-label bg-light-warning text-warning fw-bold">{{ Illuminate\Support\Str::substr($ticket->user->full_name, 0, 1) }}</span>
                            @else
                                <img src="{{ asset($ticket->user->profile_photo_path) }}" class="symbol-label">
                            @endif
                        </div>
                        <div class="pe-5">
                            <div class="d-flex align-items-center flex-wrap gap-1">
                                <span class="fw-bolder text-dark text-hover-primary">{{ $ticket->user->full_name}}</span>
                            </div>
                            <div data-kt-inbox-message="details">
                                <div class="fw-bolder badge badge-light-primary mt-3">شناسه کاربر : {{ $ticket->user_id }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse fade show" data-kt-inbox-message="message">
                    <div class="py-5">
                        <p>{{ $ticket->description }}</p>
                    </div>
                </div>
            </div>

            <div class="border my-2">
                @foreach ($ticket->children as $child)
                    <section class="card m-4">
                        <section class="card-header bg-light d-flex justify-content-between">
                            <div> {{ $child->user->first_name . ' ' . $child->user->last_name }} - پاسخ
                                دهنده :
                                {{ $child->admin ? $child->admin->user->first_name . ' ' . $child->admin->user->last_name : 'نامشخص' }}
                            </div>
                            <small>{{ jdate($child->created_at) }}</small>
                        </section>
                        <section class="card-body">
                            <p class="card-text">
                                {{ $child->description }}
                            </p>
                        </section>

                    </section>
                @endforeach
            </div>

            @if ($ticket->ticket_id === null)
                <div class="separator my-6"></div>
                <form id="form" class="form" action="{{ route('admin.tickets.answer', [$ticket->id]) }}" method="post">
                    @csrf
                    <div class="row mb-8">
                        <div class="col-xl-3 text-md-end">
                            <div class="fs-6 fw-bold mt-2 mb-3">پاسخ ادمین</div>
                        </div>
                        <div class="col-xl-9 fv-row">
                            <textarea name="description" value="{{ old('description') }}" class="form-control form-control-solid h-100px"></textarea>
                        </div>
                        @error('description')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    <div class="badge badge-light-danger">{{ $message }}</div>
                                </div>
                            @enderror
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">لغو</button>
                        <button type="submit" class="btn btn-primary" id="kt_project_settings_submit">ذخیره</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
