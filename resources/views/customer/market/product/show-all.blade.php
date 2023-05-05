@extends('customer.layouts.master-one-col')


@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">

                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        <form action="{{ route('customer.products') }}" method="get">
                            <input type="hidden" name="sort" value="{{ request()->sort }}">
                            <!-- start sidebar nav-->
                            <section class="sidebar-nav">
                                @foreach ($productCategories as $productCategory)
                                <section class="sidebar-nav-item">
                                    <span class="sidebar-nav-item-title">{{ $productCategory->name }}<i
                                            class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper py-1 px-2">
                                        @foreach ($productCategory->children as $subCategory)
                                        <section class="sidebar-nav-sub-item">
                                            @if ($subCategory->children()->count() > 0)
                                            <span class="sidebar-nav-sub-item-title"><a href="{{ route('customer.products', ['product_category' => $subCategory->id, 'search' => request()->search, 'sort' => '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}" class="d-inline">{{ $subCategory->name }}</a><i class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                @foreach ($subCategory->children as $subSubCategory)
                                                <section class="sidebar-nav-sub-sub-item"><a href="{{ route('customer.products', ['product_category' => $subSubCategory->id, 'search' => request()->search, 'sort' => '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">{{ $subSubCategory->name }}</a>
                                                </section>
                                                @endforeach
                                            </section>
                                            @else
                                            <span class="sidebar-nav-sub-item-title"><a href="{{ route('customer.products', ['product_category' => $subCategory->id, 'search' => request()->search, 'sort' => '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">{{ $subCategory->name }}</a></span>
                                            @endif
                                        </section>
                                        @endforeach
                                    </section>
                                </section>
                                @endforeach
                            </section>
                            <!--end sidebar nav-->
                    </section>

                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    جستجو در نتایج
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        <section class="">
                            <input class="sidebar-input-text" type="text" placeholder="جستجو بر اساس نام، برند ..."
                                value="{{ request()->search }}" name="search">
                        </section>
                    </section>

                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    برند
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        <section class="sidebar-brand-wrapper">
                            {{-- {{ dd(request()->brands) }} --}}
                            @foreach ($brands as $brand)
                                <section class="form-check sidebar-brand-item">
                                    <input class="form-check-input" name="brands[]"
                                        @if (request()->brands && in_array($brand->id, request()->brands)) checked @endif type="checkbox" if
                                        value="{{ $brand->id }}" id="{{ $brand->id }}">
                                    <label class="form-check-label d-flex justify-content-between"
                                        for="{{ $brand->id }}">
                                        <span>{{ $brand->persian_name }}</span>
                                        <span>{{ $brand->original_name }}</span>
                                    </label>
                                </section>
                            @endforeach

                        </section>
                    </section>



                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    محدوده قیمت
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <section class="sidebar-price-range d-flex justify-content-between">
                            <section class="p-1"><input type="text" placeholder="قیمت از ..." name="min_price"
                                    value="{{ request()->min_price }}"></section>
                            <section class="p-1"><input type="text" placeholder="قیمت تا ..." name="max_price"
                                    value="{{ request()->max_price }}"></section>
                        </section>
                    </section>



                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        <section class="sidebar-filter-btn d-grid gap-2">
                            <button class="btn btn-danger" type="submit">اعمال فیلتر</button>
                        </section>
                    </section>

                    </form>


                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <section class="filters mb-3">
                            @if (request()->search)
                                <span class="d-inline-block border p-1 rounded bg-light">
                                    نتیجه جستجو برای :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->search }}
                                    </span>
                                </span>
                            @endif
                            @if (request()->brands)
                                <span class="d-inline-block border p-1 rounded bg-light">
                                    برند :
                                    <span class="badge bg-info text-dark">
                                        {{ implode(', ', $selectedBrandsArray) }}
                                    </span>
                                </span>
                            @endif
                            @if (request()->product_category)
                                <span class="d-inline-block border p-1 rounded bg-light">
                                    دسته :
                                    <span class="badge bg-info text-dark">
                                        {{ $category->name }}
                                    </span>
                                </span>
                            @endif
                            @if (request()->min_price)
                                <span class="d-inline-block border p-1 rounded bg-light">
                                    قیمت از :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->min_price }} تومان
                                    </span>
                                </span>
                            @endif
                            @if (request()->max_price)
                                <span class="d-inline-block border p-1 rounded bg-light">
                                    قیمت تا :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->max_price }} تومان
                                    </span>
                                </span>
                            @endif

                        </section>
                        <section class="sort ">
                            <span>مرتب سازی بر اساس : </span>
                            <a class="btn {{ request()->sort == 1 ? 'btn-info' : '' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['search' => request()->search, 'sort' => '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">جدیدترین</a>
                            <a class="btn {{ request()->sort == 2 ? 'btn-info' : '' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['search' => request()->search, 'sort' => '2', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">گران
                                ترین</a>
                            <a class="btn {{ request()->sort == 3 ? 'btn-info' : '' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['search' => request()->search, 'sort' => '3', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">ارزان
                                ترین</a>
                            <a class="btn {{ request()->sort == 5 ? 'btn-info' : '' }} btn-sm px-1 py-0"
                                href="{{ route('customer.products', ['search' => request()->search, 'sort' => '5', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">پرفروش
                                ترین</a>
                        </section>


                        <section class="main-product-wrapper row my-4">


                            @forelse ($products as $product)
                                <section class="col-md-3 p-0">
                                    <section class="product">
                                        @guest
                                            <section class="product-add-to-favorite">
                                                <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-favorites', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </section>
                                            @endguest
                                            @auth
                                                @if ($product->users->contains(auth()->user()->id))
                                                <section class="product-add-to-favorite">
                                                    <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-favorites', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی">
                                                        <i class="fa fa-heart text-danger"></i>
                                                    </button>
                                                </section>
                                                @else
                                                <section class="product-add-to-favorite">
                                                    <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-favorites', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه به علاقه مندی">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </section>
                                                @endif
                                            @endauth
                                        <a class="product-link" href="{{ route('customer.market.product', $product) }}">
                                            <section class="product-image">
                                                <img class=""
                                                    src="{{ asset($product->image_path['indexArray']['medium']) }}"
                                                    alt="">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name">
                                                <h3>{{ $product->name }}</h3>
                                            </section>
                                            <section class="product-price-wrapper">
                                                <section class="product-price">{{ number_format($product->price) }}
                                                </section>
                                            </section>
                                        </a>
                                    </section>
                                </section>
                            @empty
                                <h1 class="text-danger">محصولی یافت نشد</h1>
                            @endforelse


                            {{ $products->links() }}

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection

@section('script')
    <script>
        $('.product-add-to-favorite button').click(function() {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function(result) {
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger')
                        $(element).attr('data-original-title', 'افزودن از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی ها');
                    } else if (result.status == 3) {
                        $('.toast').toast('show');
                    }
                }
            })
        })
    </script>
@endsection
