@extends('admin.layouts.app')

@section('title', 'ویرایش کالا')

@push('head-tag')
    <script src="{{ asset('admin-assets/ckeditor/build/ckeditor.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalali-datepicker/persian-datepicker.min.css') }}"/>
@endpush

@section('page-title', 'ویرایش کالا')

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
    <li class="breadcrumb-item text-dark">ویرایش کالا</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">مشخصات کالا</div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <a href="{{ route('admin.market.products.index') }}" class="btn btn-primary">بازگشت</a>
            </div>
        </div>
        <form id="form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.market.products.update', [$product->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body p-9">
                <div class="row mb-5">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">تصویر کالا</div>
                    </div>
                    <div class="col-lg-8">
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('admin-assets/media/svg/files/blank-image.svg') }})">
                            <div class="image-input-wrapper w-150px h-150px bgi-position-center" style="background-size: 100%; background-image: url({{ asset(Illuminate\Support\Str::replace('\\', '/', $product->image_path['indexArray']['medium'])) }})"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تعویض تصویر">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="image_path">
                                <input type="hidden" name="image_remove">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف تصویر">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="حذف تصویر">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        @error('image_path')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">نام کالا</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="name" value="{{ old('name', $product->name) }}" />
                        @error('name')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">قیمت</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="number" class="form-control form-control-solid" name="price" value="{{ old('price', str_replace('.000', '', $product->price)) }}" />
                        @error('price')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">وزن</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="weight" value="{{ old('weight', $product->weight) }}" />
                        @error('weight')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">طول</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="length" value="{{ old('length', $product->length) }}" />
                        @error('length')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">عرض</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="width" value="{{ old('width', $product->width) }}" />
                        @error('width')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">ارتفاع</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="text" class="form-control form-control-solid" name="height" value="{{ old('height', $product->height) }}" />
                        @error('height')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">برچسب ها</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <input type="hidden" id="tags" class="form-control form-control-solid" name="tags" value="{{ old('tags', $product->tags) }}" />
                        <select class="form-control form-control-solid select2" id="select_tags" multiple tabindex="-1" aria-hidden="true"></select>
                        @error('tags')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">برند</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="w-100">
                            <select class="form-select form-select-solid" name="brand_id" data-control="select2"
                                data-hide-search="true">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id) == $brand->id)>{{ $brand->original_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('brand_id')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">دسته بندی</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="w-100">
                            <select class="form-select form-select-solid" name="category_id" data-control="select2"
                                data-hide-search="true">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">قابل فروش</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="w-100">
                            <select class="form-select form-select-solid" name="marketable" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @selected(old('marketable', $product->marketable) == 0)>غیر فعال</option>
                                <option value="1" @selected(old('marketable', $product->marketable) == 1)>فعال</option>
                            </select>
                        </div>
                        @error('marketable')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">وضعیت</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="w-100">
                            <select class="form-select form-select-solid" name="status" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @selected(old('status', $product->status) == 0)>غیر فعال</option>
                                <option value="1" @selected(old('status', $product->status) == 1)>فعال</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">تاریخ انتشار</div>
                    </div>
                    <div class="col-xl-9 fv-row fv-plugins-icon-container">
                        <div class="position-relative d-flex align-items-center">
                            <span class="svg-icon position-absolute ms-4 mb-1 svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"></path>
                                    <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"></path>
                                    <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <input class="form-control form-control-solid ps-12 d-none" name="published_at" id="published_at" type="text" value="{{ old('published_at') }}">
                            <input class="form-control form-control-solid ps-12" placeholder="انتخاب تاریخ" id="published_at_view" type="text" value="{{ old('published_at', $product->published_at) }}">
                        </div>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @error('published_at')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3">توضیحات</div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <textarea name="description" id="editor" class="form-control form-control-solid h-100px">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div class="badge badge-light-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="separator my-5"></div>
                @foreach ($product->productMeta as $meta)
                <div class="row mb-8">
                    <div class="col-xl-3 text-md-end">
                        <div class="fs-6 fw-bold mt-2 mb-3"></div>
                    </div>
                    <div class="col-xl-4">
                        <input type="text" class="form-control form-control-solid" name="meta_key[{{ $meta->id }}]" value="{{ $meta->meta_key }}" />
                    </div>
                    <div class="col-xl-4">
                        <input type="text" class="form-control form-control-solid" name="meta_value[]" value="{{ $meta->meta_value }}" />
                    </div>
                </div>
                @endforeach
                
                <div class="col-12">
                    <button type="button" id="btn-copy" class="btn btn-sm btn-light-primary">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11" y="18" width="12" height="2"
                                    rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                <rect x="6" y="11" width="12" height="2" rx="1"
                                    fill="currentColor"></rect>
                            </svg>
                        </span>
                        افزودن
                    </button>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">لغو</button>
                <button type="submit" class="btn btn-primary" id="kt_project_settings_submit">ذخیره</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ asset('admin-assets/jalali-datepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalali-datepicker/persian-datepicker.min.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $(document).ready(function() {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var tags_input_value = tags_input.val();
            var default_data = null;

            if (tags_input_value !== null && tags_input_value.length > 0) {
                default_data = tags_input_value.split(',');
            }

            select_tags.select2({
                tags: true,
                data: default_data
            });

            select_tags.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function(event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectSource = select_tags.val().join(',');
                    tags_input.val(selectSource);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function (){
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            });
        });
    </script>

    <script>
        $(function () {
            $('#btn-copy').on('click', function(){
                var ele = $(this).parent().prev().clone(true);
                $(this).before(ele);
            })
        })
    </script>
@endpush
