<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
    <head>
        <base href="">
        <title>@yield('title')</title>
        @include('admin.layouts.head-tag')
        @stack('head-tag')
    </head>
    <body id="kt_body"
        class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
        style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">               
                <!--begin::sidebar-->
                @include('admin.layouts.sidebar')
                <!--end::sidebar-->
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <!--begin::Header-->
                    @include('admin.layouts.header')
                    <!--end::Header-->
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Toolbar-->
                        @include('admin.layouts.toolbar')
                        <!--end::Toolbar-->
                        <!--begin::Post-->
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">
                                @yield('content')
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Post-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->
        <!--end::Main-->
        <!--begin::Scrolltop-->
        @include('admin.layouts.scrolltop')
        <!--end::Scrolltop-->
        <!--begin::Javascript-->
        @include('admin.layouts.script')
        @stack('script')
        <!--end::Javascript-->
        @includeWhen(session('swal-success'), 'admin.alerts.sweetalert.success')
        @includeWhen(session('swal-error'), 'admin.alerts.sweetalert.error')
        @includeWhen(session('toastr-success'), 'admin.alerts.toastr.success')
        @includeWhen(session('toastr-error'), 'admin.alerts.toastr.error')
    </body>
</html>
