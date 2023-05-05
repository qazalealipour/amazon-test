@extends('admin.layouts.app')

@section('title', 'داشبورد')

@push('head-tag')
    <link href="{{ asset('admin-assets/plugins/custom/vis-timeline/vis-timeline.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title', 'داشبورد')

@section('content')
    
@endsection

@push('script')
    <script src="{{ asset('admin-assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
@endpush