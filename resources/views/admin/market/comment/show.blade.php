@extends('admin.layouts.app')

@section('title', 'نمایش نظر')

@section('page-title', 'نمایش نظر')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">ویترین</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">نظرات</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">نمایش نظر</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header align-items-center py-5 gap-5">
            <div class="d-flex"></div>
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.market.comments.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <h1 class="d-flex text-dark fw-bolder fs-2 align-items-center my-1">مشخصات پست</h1>
                    <span class="badge badge-light-primary my-1 me-2"> شناسه پست : {{ $comment->commentable_id }}</span>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <span class="fs-5 text-gray-600 fw-bold text-dark lh-base">{{ $comment->commentable->title }}</span>
                </div>
            </div>
            <div data-kt-inbox-message="message_wrapper">
                <div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50 me-4">
                            @if ($comment->author->profile_photo_path === null)
                                <span class="symbol-label bg-light-warning text-warning fw-bold">{{ Illuminate\Support\Str::substr($comment->author->full_name, 0, 1) }}</span>
                            @else
                                <img src="{{ asset($comment->author->profile_photo_path['indexArray']['small']) }}" class="symbol-label">
                            @endif
                        </div>
                        <div class="pe-5">
                            <div class="d-flex align-items-center flex-wrap gap-1">
                                <span class="fw-bolder text-dark text-hover-primary">{{ $comment->author->full_name}}</span>
                            </div>
                            <div data-kt-inbox-message="details">
                                <div class="fw-bolder badge badge-light-primary mt-3">شناسه کاربر : {{ $comment->author_id }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse fade show" data-kt-inbox-message="message">
                    <div class="py-5">
                        <p>{{ $comment->body }}</p>
                    </div>
                </div>
            </div>
            @if ($comment->parent_id === null)
                <div class="separator my-6"></div>
                <form id="form" class="form" action="{{ route('admin.market.comments.answer', [$comment->id]) }}" method="post">
                    @csrf
                    <div class="row mb-8">
                        <div class="col-xl-3 text-md-end">
                            <div class="fs-6 fw-bold mt-2 mb-3">پاسخ ادمین</div>
                        </div>
                        <div class="col-xl-9 fv-row">
                            <textarea name="body" value="{{ old('body') }}" class="form-control form-control-solid h-100px"></textarea>
                        </div>
                        @error('body')
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
