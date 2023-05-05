<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                            fill="currentColor" />
                        <path opacity="0.3"
                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::sidebar mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('admin.home') }}" class="d-lg-none">
                <img alt="Logo" src="{{ asset('admin-assets/media/logos/logo-2.svg') }}" class="h-30px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav"></div>
            <!--end::Navbar-->
            <!--begin::Toolbar wrapper-->
            <div class="d-flex align-items-stretch flex-shrink-0">
                <!--begin::جستجو-->
                <div class="d-flex align-items-stretch ms-1 ms-lg-3">
                    <!--begin::جستجو-->
                    <div id="kt_header_search" class="header-search d-flex align-items-stretch"
                        data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter"
                        data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false"
                        data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                        <!--begin::جستجو toggle-->
                        <div class="d-flex align-items-center" data-kt-search-element="toggle"
                            id="kt_header_search_toggle">
                            <div
                                class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                            height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                            fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <!--end::جستجو toggle-->
                        <!--begin::Menu-->
                        <div data-kt-search-element="content"
                            class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px">
                            <!--begin::Wrapper-->
                            <div data-kt-search-element="wrapper">
                                <!--begin::Form-->
                                <form data-kt-search-element="form" class="w-100 position-relative mb-3"
                                    autocomplete="off">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span
                                        class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 translate-middle-y ms-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                fill="currentColor" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Input-->
                                    <input type="text" class="search-input form-control form-control-flush ps-10"
                                        name="search" value="" placeholder="جستجو..."
                                        data-kt-search-element="input" />
                                    <!--end::Input-->
                                    <!--begin::Spinner-->
                                    <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-1"
                                        data-kt-search-element="spinner">
                                        <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                                    </span>
                                    <!--end::Spinner-->
                                    <!--begin::ریست-->
                                    <span
                                        class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none"
                                        data-kt-search-element="clear">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                    height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                                    fill="currentColor" />
                                                <rect x="7.41422" y="6" width="16" height="2"
                                                    rx="1" transform="rotate(45 7.41422 6)"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--end::ریست-->
                                    <!--begin::Toolbar-->
                                    <div class="position-absolute top-50 end-0 translate-middle-y"
                                        data-kt-search-element="toolbar">
                                        <!--begin::اولویت ها toggle-->
                                        <div data-kt-search-element="preferences-show"
                                            class="btn btn-icon w-20px btn-sm btn-active-color-primary me-1"
                                            data-bs-toggle="tooltip" title="نمایش تنظیمات جستجو">
                                            <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::اولویت ها toggle-->
                                        <!--begin::پیشرفته search toggle-->
                                        <div data-kt-search-element="advanced-options-form-show"
                                            class="btn btn-icon w-20px btn-sm btn-active-color-primary"
                                            data-bs-toggle="tooltip" title="تنظیمات بیشتر">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::پیشرفته search toggle-->
                                    </div>
                                    <!--end::Toolbar-->
                                </form>
                                <!--end::Form-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200 mb-6"></div>
                                <!--end::Separator-->
                                <!--begin::اخیرly viewed-->
                                <div data-kt-search-element="results" class="d-none">
                                    <!--begin::Items-->
                                    <div class="scroll-y mh-200px mh-lg-350px">
                                        <!--begin::دسته بندی title-->
                                        <h3 class="fs-5 text-muted m-0 pb-5" data-kt-search-element="category-title">
                                            کاربران</h3>
                                        <!--end::دسته بندی title-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-6.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">کارینا کالرک</span>
                                                <span class="fs-7 fw-bold text-muted">مدیریت بازاریابی</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-2.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">غلامی</span>
                                                <span class="fs-7 fw-bold text-muted">مهندس نرم افزار</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-9.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">حسینی</span>
                                                <span class="fs-7 fw-bold text-muted">طراح یو ای و یوایکس</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-14.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">موسوی</span>
                                                <span class="fs-7 fw-bold text-muted">کارگردان هنری</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-11.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">بناری</span>
                                                <span class="fs-7 fw-bold text-muted">System مدیریت</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::دسته بندی title-->
                                        <h3 class="fs-5 text-muted m-0 pt-5 pb-5"
                                            data-kt-search-element="category-title">مشتریان</h3>
                                        <!--end::دسته بندی title-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px"
                                                        src="assets/media/svg/brand-logos/volicity-9.svg"
                                                        alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">کمپانی ریبرندینگ</span>
                                                <span class="fs-7 fw-bold text-muted">طراح</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px"
                                                        src="assets/media/svg/brand-logos/tvit.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">کمپانی ری برندینگ</span>
                                                <span class="fs-7 fw-bold text-muted">توسعه دهنده وب</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px"
                                                        src="assets/media/svg/misc/infography.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">بیزینس آنالیتیکس اپلیکیشن</span>
                                                <span class="fs-7 fw-bold text-muted">مدیریت</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px"
                                                        src="assets/media/svg/brand-logos/leaf.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">اکولیف اپلیکیشن لانچ</span>
                                                <span class="fs-7 fw-bold text-muted">بازاریابی</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px"
                                                        src="assets/media/svg/brand-logos/tower.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">قدرت گروه وب سایت</span>
                                                <span class="fs-7 fw-bold text-muted">گوگل Adwords</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::دسته بندی title-->
                                        <h3 class="fs-5 text-muted m-0 pt-5 pb-5"
                                            data-kt-search-element="category-title">پروژه ها</h3>
                                        <!--end::دسته بندی title-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                                                                fill="currentColor" />
                                                            <rect x="7" y="17" width="6"
                                                                height="2" rx="1" fill="currentColor" />
                                                            <rect x="7" y="12" width="10"
                                                                height="2" rx="1" fill="currentColor" />
                                                            <rect x="7" y="7" width="6"
                                                                height="2" rx="1" fill="currentColor" />
                                                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <span class="fs-6 fw-bold">پروژه توسط ساتراس وب</span>
                                                <span class="fs-7 fw-bold text-muted">#45670</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect x="8" y="9" width="3"
                                                                height="10" rx="1.5" fill="currentColor" />
                                                            <rect opacity="0.5" x="13" y="5"
                                                                width="3" height="14" rx="1.5"
                                                                fill="currentColor" />
                                                            <rect x="18" y="11" width="3"
                                                                height="8" rx="1.5" fill="currentColor" />
                                                            <rect x="3" y="13" width="3"
                                                                height="6" rx="1.5" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <span class="fs-6 fw-bold">اپلیکیشن فونیکس</span>
                                                <span class="fs-7 fw-bold text-muted">#45690</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                fill="currentColor" />
                                                            <rect x="6" y="12" width="7"
                                                                height="2" rx="1" fill="currentColor" />
                                                            <rect x="6" y="7" width="12"
                                                                height="2" rx="1" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <span class="fs-6 fw-bold">Finance Monitoring SAAS Discussion</span>
                                                <span class="fs-7 fw-bold text-muted">#21090</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#"
                                            class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <span class="fs-6 fw-bold">داشبورد انالیتیکس</span>
                                                <span class="fs-7 fw-bold text-muted">#34560</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::اخیرly viewed-->
                                <!--begin::اخیرly viewed-->
                                <div class="mb-5" data-kt-search-element="main">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-stack fw-bold mb-4">
                                        <!--begin::Tags-->
                                        <span class="text-muted fs-6 me-2">نتایج اخیر:</span>
                                        <!--end::Tags-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Items-->
                                    <div class="scroll-y mh-200px mh-lg-325px">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc004.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M2 16C2 16.6 2.4 17 3 17H21C21.6 17 22 16.6 22 16V15H2V16Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.3"
                                                                d="M21 3H3C2.4 3 2 3.4 2 4V15H22V4C22 3.4 21.6 3 21 3Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.3" d="M15 17H9V20H15V17Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">ساتراس وب</a>
                                                <span class="fs-7 text-muted fw-bold">#45789</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">"ملاقات پروژه
                                                    ها</a>
                                                <span class="fs-7 text-muted fw-bold">#84050</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra006.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.3"
                                                                d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">مانیتورینگ
                                                    اپلیکیشن لانچ</a>
                                                <span class="fs-7 text-muted fw-bold">#84250</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra002.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">سوالات
                                                    متداول</a>
                                                <span class="fs-7 text-muted fw-bold">#67945</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.3"
                                                                d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">"اپلیکیشن کیت
                                                    پرو</a>
                                                <span class="fs-7 text-muted fw-bold">#84250</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.3"
                                                                d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">اپلیکیشن
                                                    فونیکس</a>
                                                <span class="fs-7 text-muted fw-bold">#45690</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra002.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">"صفحه فرود
                                                    طراح" لانچ</a>
                                                <span class="fs-7 text-muted fw-bold">#24005</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::اخیرly viewed-->
                                <!--begin::Empty-->
                                <div data-kt-search-element="empty" class="text-center d-none">
                                    <!--begin::Icon-->
                                    <div class="pt-10 pb-10">
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                        <span class="svg-icon svg-icon-4x opacity-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z"
                                                    fill="currentColor" />
                                                <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z"
                                                    fill="currentColor" />
                                                <rect x="13.6993" y="13.6656" width="4.42828" height="1.73089"
                                                    rx="0.865447" transform="rotate(45 13.6993 13.6656)"
                                                    fill="currentColor" />
                                                <path
                                                    d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Message-->
                                    <div class="pb-15 fw-bold">
                                        <h3 class="text-gray-600 fs-5 mb-2">نتیجه اییافتنشد</h3>
                                        <div class="text-muted fs-7">لطفاً با یک پرسش دیگر دوباره امتحان کنید</div>
                                    </div>
                                    <!--end::Message-->
                                </div>
                                <!--end::Empty-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::اولویت ها-->
                            <form data-kt-search-element="advanced-options-form" class="pt-1 d-none">
                                <!--begin::Heading-->
                                <h3 class="fw-bold text-dark mb-7">پیشرفته جستجو</h3>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <input type="text" class="form-control form-control-sm form-control-solid"
                                        placeholder="حاوی کلمه است" name="query" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <!--begin::رادیو group-->
                                    <div class="nav-group nav-group-fluid">
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="has"
                                                checked="checked" />
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary">همه</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="users" />
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">کاربران</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="orders" />
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">سفارشات</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="type"
                                                value="projects" />
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">پروژه
                                                ها</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::رادیو group-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <input type="text" name="assignedto"
                                        class="form-control form-control-sm form-control-solid"
                                        placeholder="اختصاص دادن" value="" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <input type="text" name="collaborators"
                                        class="form-control form-control-sm form-control-solid" placeholder="همکاران"
                                        value="" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <!--begin::رادیو group-->
                                    <div class="nav-group nav-group-fluid">
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="attachment" value="has"
                                                checked="checked" />
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary">ضمیمه
                                                دار</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="attachment"
                                                value="any" />
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">هیچ</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::رادیو group-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <select name="timezone" aria-label="انتخاب زمان محلی" data-control="select2"
                                        data-placeholder="date_period"
                                        class="form-select form-select-sm form-select-solid">
                                        <option value="next">بعدی</option>
                                        <option value="last">قبلی</option>
                                        <option value="between">بین</option>
                                        <option value="on">روشن</option>
                                    </select>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-8">
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <input type="number" name="date_number"
                                            class="form-control form-control-sm form-control-solid" placeholder="طول"
                                            value="" />
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <select name="date_typer" aria-label="انتخاب زمان محلی"
                                            data-control="select2" data-placeholder="Period"
                                            class="form-select form-select-sm form-select-solid">
                                            <option value="days">روزها</option>
                                            <option value="weeks">هفته ها</option>
                                            <option value="months">ماه ها</option>
                                            <option value="years">سال ها</option>
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset"
                                        class="btn btn-sm btn-light fw-bolder btn-active-light-primary me-2"
                                        data-kt-search-element="advanced-options-form-cancel">انصراف</button>
                                    <a href="../../demo1/dist/pages/search/horizontal.html"
                                        class="btn btn-sm fw-bolder btn-primary"
                                        data-kt-search-element="advanced-options-form-search">جستجو</a>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::اولویت ها-->
                            <!--begin::اولویت ها-->
                            <form data-kt-search-element="preferences" class="pt-1 d-none">
                                <!--begin::Heading-->
                                <h3 class="fw-bold text-dark mb-7">جستجو پرفرمنس</h3>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="pb-4 border-bottom">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">پروژه
                                            ها</span>
                                        <input class="form-check-input" type="checkbox" value="1"
                                            checked="checked" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="py-4 border-bottom">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span
                                            class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">اهداف</span>
                                        <input class="form-check-input" type="checkbox" value="1"
                                            checked="checked" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="py-4 border-bottom">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">برنامه
                                            بازاریابی</span>
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="py-4 border-bottom">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span
                                            class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">مراجعات</span>
                                        <input class="form-check-input" type="checkbox" value="1"
                                            checked="checked" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="py-4 border-bottom">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span
                                            class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">کاربران</span>
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end pt-7">
                                    <button type="reset"
                                        class="btn btn-sm btn-light fw-bolder btn-active-light-primary me-2"
                                        data-kt-search-element="preferences-dismiss">انصراف</button>
                                    <button type="submit" class="btn btn-sm fw-bolder btn-primary">ذخیره
                                        تغییرات</button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::اولویت ها-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::جستجو-->
                </div>
                <!--end::جستجو-->
                <!--begin::اعلان ها-->
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <!--begin::Menu- wrapper-->
                    <div class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px position-relative"
                        id="notification" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z"
                                    fill="currentColor" />
                                <path
                                    d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        @if ($notifications->count() > 0)
                            <span
                                class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                        @endif
                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column bgi-no-repeat rounded-top"
                            style="background-image:url({{ asset('admin-assets/media/misc/pattern-1.jpg') }})">
                            <!--begin::Title-->
                            <h3 class="text-white fw-bold px-9 mt-10 mb-6">نوتیفیکیشن ها
                                <span class="fs-8 opacity-75 ps-3">{{ $notifications->count() }} نوتیفیکیشن</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Tabs-->
                            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
                                <li class="nav-item">
                                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active"
                                        data-bs-toggle="tab" href="#kt_topbar_notifications_3">گزارش</a>
                                </li>
                            </ul>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Tab content-->
                        <div class="tab-content">

                            <!--begin::Tab panel-->
                            <div class="tab-pane fade show active" id="kt_topbar_notifications_3" role="tabpanel">
                                <!--begin::Items-->
                                <div class="scroll-y mh-325px my-5 px-8">
                                    <!--begin::Item-->
                                    @foreach ($notifications as $notification)
                                        <div class="d-flex flex-stack py-4">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center me-2">
                                                <div class="symbol symbol-35px me-4">
                                                    <span class="symbol-label bg-light-primary">
                                                        <!--begin::Svg Icon | path: icons/duotune/maps/map001.svg-->
                                                        <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.5"
                                                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                                                    fill="currentColor"></path>
                                                                <path
                                                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                                                    fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </div>
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 text-hover-primary fw-bold">{{ json_decode($notification->data)->message }}</a>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Tags-->
                                            {{-- <span class="badge badge-light fs-8">فقط</span> --}}
                                            <!--end::Tags-->
                                        </div>
                                    @endforeach
                                    <!--end::Item-->
                                </div>
                                <!--end::Items-->
                                <!--begin::نمایش more-->
                                {{-- <div class="py-3 text-center border-top">
                                    <a href="../../demo1/dist/pages/user-profile/activity.html"
                                        class="btn btn-color-gray-600 btn-active-color-primary">نمایش همه
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13"
                                                    height="2" rx="1" transform="rotate(-180 18 13)"
                                                    fill="currentColor" />
                                                <path
                                                    d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </div> --}}
                                <!--end::نمایش more-->
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab content-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::اعلان ها-->
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <!--begin::Menu- wrapper-->
                    <div class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px position-relative"
                        data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3"
                                    d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                    fill="currentColor"></path>
                                <rect x="6" y="12" width="7" height="2" rx="1"
                                    fill="currentColor"></rect>
                                <rect x="6" y="7" width="12" height="2" rx="1"
                                    fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        @if ($unseenComments->count() > 0)
                            <span
                                class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                        @endif
                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
                        <div class="card card-flush">
                            <!--begin::Card header-->
                            <div class="card-header pt-7" id="kt_chat_contacts_header">
                                <!--begin::Form-->
                                <form class="w-100 position-relative" autocomplete="off">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span
                                        class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                fill="currentColor"></rect>
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid px-15"
                                        name="search" value=""
                                        placeholder="با نام کاربری یا ایمیل جستجو کنید ...">
                                    <!--end::Input-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-5" id="kt_chat_contacts_body">
                                <!--begin::لیست-->
                                <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true"
                                    data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header"
                                    data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body"
                                    data-kt-scroll-offset="5px" style="max-height: 292px;">
                                    @foreach ($unseenComments as $unseenComment)
                                        <div class="d-flex flex-stack py-4">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px symbol-circle">
                                                    @if ($unseenComment->author->profile_photo_path == null)
                                                        <span>
                                                            <div
                                                                class="symbol-label fs-3 bg-light-primary text-primary">
                                                                {{ Illuminate\Support\Str::substr($unseenComment->author->first_name, 0, 1) }}
                                                            </div>
                                                        </span>
                                                    @else
                                                        <span>
                                                            <div class="symbol-label">
                                                                <img src="{{ asset($unseenComment->author->profile_photo_path) }}"
                                                                    class="w-100">
                                                            </div>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="ms-5">
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">{{ $unseenComment->author->full_name }}</a>
                                                    <div class="fw-bold text-muted">{{ $unseenComment->author->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column align-items-end ms-2">
                                                {{-- <span class="text-muted fs-7 mb-1">1 هفته</span>
                                                <span class="badge badge-sm badge-circle badge-light-success">2</span> --}}
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed d-none"></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--begin::کاربر menu-->
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        @if (auth()->user()->profile_photo_path == null)
                            <span
                                class="symbol-label bg-light-warning text-warning fw-bold">{{ Illuminate\Support\Str::substr(auth()->user()->first_name, 0, 1) }}</span>
                        @else
                            <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt="user" />
                        @endif
                    </div>
                    <!--begin::کاربر account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    @if (auth()->user()->profile_photo_path === null)
                                        <span
                                            class="symbol-label bg-light-warning text-warning fw-bold">{{ Illuminate\Support\Str::substr(auth()->user()->first_name, 0, 1) }}</span>
                                    @else
                                        <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt="user" />
                                    @endif
                                </div>
                                <!--end::Avatar-->
                                <!--begin::کاربرname-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->full_name }}
                                    </div>
                                    <a href="#"
                                        class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                </div>
                                <!--end::کاربرname-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}" class="menu-link px-5">خروج</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::کاربر account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::کاربر menu-->
                <!--begin::Header menu toggle-->
                <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="مشاهده header menu">
                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                        id="kt_header_menu_mobile_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                                    fill="currentColor" />
                                <path opacity="0.3"
                                    d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Header menu toggle-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
