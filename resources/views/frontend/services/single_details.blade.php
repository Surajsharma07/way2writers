@php
    $ASSET_URL = asset('user-theme') . '/';
    $price_symbol = getSetting()->default_symbol ?? '$';
@endphp
@extends('frontend.layout.master')
@section('head_scripts')
    @php
        $mUrl = Request::url();
        $mImage = Storage::url(getSetting()->preview_image);
        $mTitle = @$product->meta_title;
        $mDescr = @$product->meta_desc;
        $mKWords = @$product->meta_keywords;
    @endphp
    <title>
        {{ @$mTitle }}</title>
    <meta name="keywords" content="{{ @$mKWords }}" />
    <meta name="description" content="{{ @$mDescr }}" />
    <meta property="og:locale" content="en_US" />
    <meta property=og:type content=website />
    <meta property="og:site_name" content="Coin Gabbar" />
    <meta property="og:title" content="{{ @$mTitle }}" />
    <meta property="og:description" content="{{ @$mDescr }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ @$mImage }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="twitter:title" content="{{ @$mTitle }}" />
    <meta property="twitter:description" content="{{ @$mDescr }}" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:image" content="{{ @$mImage }}" />
    <meta name="twitter:site" content="@themeportal" />
    <meta name="twitter:creator" content="@themeportal" />
@endsection
@section('content')

        <div class="card bg-dark text-white">
  <img src="{{ $ASSET_URL }}assets/images/my_images/images/product-banner.jpg" class="card-img" alt="..." style="
    height: 300px;">
  <div class="card-img-overlay">
    <h5 class="card-title"> {{ @$product->name }}</h5>
    <p class="card-text">{{ @$product->short_desc }}</p>
    <p class="card-text">Get the job
                                you deserve with a powerful, interview-winning resume.</p>
  </div>
</div>
        <!--=== Single Product Details Section Start===-->
        <section class="row white-bg">
            <div class="col-sm-12">
                <div class="col-sm-12 product-page-content" style="display:block;" id="infographic">
                    <div class="row">
                        {!! @$product->description !!}

                        <div class="col-sm-3 ">
                            <div class="row rht-colm">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div>

                                        <form id="add-to-card-form" method="POST">
                                            <div class="tp_sidebar_category tp_sidebar_category_single">
                                                <div class="tp_leftbar_box">
                                                    @if (@$product->is_free == '1')
                                                        <div class="tp_flex_price">
                                                            <p>Price</p>
                                                            <div class="tp_lowprice">
                                                                <h2>
                                                                    @if (!empty($product->price))
                                                                        <del>{{ $price_symbol . @$product->price }}</del>
                                                                    @endif Free
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @if (@$product->is_enable_multi_price == 1 && isset($product_meta->multi_price) && !empty($product_meta->multi_price))
                                                            @php $priceArr = (object) unserialize(@$product_meta->multi_price); @endphp
                                                            @foreach ($priceArr as $key => $value)
                                                                <div class="tp_flex_price">
                                                                    <input
                                                                        @if (@$product_meta->enable_multi_option == 1) type="checkbox" @else type="radio" @endif
                                                                        value="{{ @$value['price_id'] }}" name="price_id[]"
                                                                        @if (@$value['default_price'] == 1) checked @endif>
                                                                    <p>{{ @$value['option_name'] }}</p>

                                                                    <div class="tp_lowprice">
                                                                        @if (!empty(@$value['offer_price']) && @$product->is_offer != 0)
                                                                            <h2><span>{{ $price_symbol . @$value['price'] }}</span>
                                                                                {{ $price_symbol . @$value['offer_price'] }}
                                                                            </h2>
                                                                        @else
                                                                            <h2>{{ $price_symbol . @$value['price'] }}</h2>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="tp_flex_price">
                                                                <p>@lang('master.product_search.Price')</p>
                                                                <div class="tp_lowprice">
                                                                    @if (@$product->is_offer != '0')
                                                                        <h2><span>{{ $price_symbol . @$product->price }}</span>
                                                                            {{ $price_symbol . @$product->offer_price }}
                                                                        </h2>
                                                                    @else
                                                                        <h2><span></span>{{ $price_symbol . @$product->price }}
                                                                        </h2>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if ($product->category_id != 2)
                                                        <div><br>
                                                            <input type="checkbox" value="1"
                                                                name="include_cover_letter">
                                                            <label>Include Cover Letter ({{ $price_symbol }}350)</label>
                                                        </div>
                                                    @endif


                                                    <div class="tp_product_detailhead">
                                                    </div>
                                                    <h5>Select Delivery Option</h5>
                                                    @foreach ($deliveryoptions as $option)
                                                        <div>
                                                            <input type="radio" value="{{ $option->id }}"
                                                                name="delivery_option"
                                                                @if ($option->id === 1) checked @endif>
                                                            <label>{{ $option->name }} -
                                                                {{ $price_symbol . $option->amount }}</label>
                                                    @endforeach
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="tp_leftbar_box">
                                    <div class="tp_tem_option">
                                        <div class="grid_icon">

                                            <div class="tp_buy_btn">
                                                <a href="javascript:;"
                                                    @if (Auth::check()) onclick="addToCart('',1)" @else
                                    data-bs-toggle="modal" data-bs-target="#log_modal" @endif
                                                    class="tp_btn"><img src="{{ $ASSET_URL }}assets/images/buynow.png"
                                                        alt="Image" />@lang('master.product_search.buy_now')
                                                </a>

                                                <button type="button" onclick="addToCart()" class="tp_btn"><img
                                                        src="{{ $ASSET_URL }}assets/images/addtocart.png"
                                                        alt="Image" />
                                                    @lang('master.single_product.add_to_cart')
                                                </button>
                                                @if (isset($product->preview_link) && !empty($product->preview_link))
                                                    <a target="_blank" href="{{ $product->preview_link }}"
                                                        class="tp_btn"><img
                                                            src="{{ $ASSET_URL }}assets/images/live_preview.png"
                                                            alt="Image" />@lang('master.product_search.live_preview')</a>
                                                @endif

                                                <input type="hidden" name="slug" value="{{ $product->slug }}">

                                                <button type="button"
                                                    @if (Auth::check()) onclick="addtoWishlist('{{ $product->slug }}')"
                                    class="active_red tp_btn tp_btn_wish watchlist_btn" @else data-bs-toggle="modal"
                                    data-bs-target="#log_modal" class="active_red tp_btn tp_btn_wish" @endif><i
                                                        class="fa fa-heart @if (@$product->check_in_wishlist()) active @endif"
                                                        aria-hidden="true"></i>@lang('master.single_product.add_to_wishlist')</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>

                                    <div id="message"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
    </div>
    </div>
    </div>
    <section class="row white-bg">
        <div class="col-sm-12">
            <h2 class="py-5 text-center">Samples</h2>
            @php
                $preview_imgs_arr = (array) unserialize(@$product_meta->preview_imgs);
            @endphp

            @foreach (array_chunk($preview_imgs_arr, 3) as $chunk)
                <div class="slider-item-content">
                    <div class="row">

                        @foreach ($chunk as $value)
                            <div class="col-md-4">

                                <a href="{{ getImage($value) }}" class="image-popup"
                                    data-mfp-src="{{ getImage($value) }}">
                                    <img src="{{ getImage($value) }}" alt="" class="img-fluid">
                                </a>

                            </div>
                        @endforeach
                    </div>
            @endforeach
    </section>


    <!--===Categories Section Start===-->
    <div class="tp_istop_gallery">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp_main_heading">
                        <h2>GET JOB READY NOW AT AFFORDABLE PRICE</h2>
                        <p>
                            Select a package according to your experience
                        </p>
                    </div>
                </div>
            </div>

            <div class="int_project_gallery">
                <div class="gallery_nav">
                    <ul style="width: 25%;">
                        @foreach (@$featured_category as $row)
                            <li><a data-filter=".category-{{ $row->id }}"> {{ $row->name }} </a></li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="int_project_gallery">
                            <div class="gallery_grid">
                                @if (!empty($products))
                                    @foreach ($products as $items)
                                        <div class="grid-item category-{{ $items->category_id }}">
                                            <div class="category-filter-buttons">

                                            </div>
                                            <a href="{{ route('frontend.services.single_details', $items->slug) }}">
                                                <div class=" tp-animation-box">
                                                    <div class="tp_isbox_content">
                                                        <div class="card mb-4 rounded-3 shadow-sm">
                                                            <div class="card-header py-3">
                                                                <h4 class="my-0 fw-normal text-center">{{ $items->name }}
                                                                </h4>
                                                            </div>
                                                <div class="card-body">
                                                            <h2 class="card-title pricing-card-title">
                                                                @php $productPrice = $items->productPrice(); @endphp
                                                                @if ($productPrice['free'])
                                                                    <p>
                                                                        @if (!empty($productPrice['price']))
                                                                            <del>{{ $price_symbol . @$productPrice['price'] }}</del>
                                                                        @endif FREE
                                                                    </p>
                                                                @elseif($productPrice['price'])
                                                                    @if (@$productPrice['offer_price'])
                                                                        <p><del>{{ $price_symbol }}{{ @$productPrice['price'] }}</del>
                                                                        </p>
                                                                        <p>{{ $price_symbol }}{{ @$productPrice['offer_price'] }}
                                                                        </p>
                                                                    @else
                                                                        <p>{{ $price_symbol }}{{ @$productPrice['price'] }}
                                                                        </p>
                                                                    @endif
                                                                @else
                                                                    <p>{{ $price_symbol }}{{ @$productPrice['from'] }}</p>
                                                                    <span>-</span>
                                                                    <p>{{ $price_symbol }}{{ @$productPrice['to'] }}</p>
                                                                @endif
                                                                <small class="text-body-secondary fw-light"></small>
                                                            </h2>
                                                            <ul class="list-unstyled mt-3 mb-4">
                                                                @foreach (@$items->product_details as $key => $val)
                                                                    <div class="list-group">
                                                                        <a href="#"
                                                                            class="list-group-item list-group-item-action d-flex gap-3 py-3"
                                                                            style="border: none;" aria-current="true">
                                                                            <img src="{{ $ASSET_URL }}assets/images/check.png"
                                                                                alt="twbs" width="32"
                                                                                height="32"
                                                                                class="rounded-circle flex-shrink-0">
                                                                            <div
                                                                                class="d-flex gap-2 w-100 justify-content-between">
                                                                                <div>
                                                                                    <h6 class="mb-0">
                                                                                        {{ @$val['key'] }}<span>{{ @$val['value'] }}
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </ul>



                                                            <a href="javascript:;"
                                                                @if (Auth::check()) onclick="addToCart('',1)"
                                                    @else data-bs-toggle="modal" data-bs-target="#log_modal" @endif
                                                                class="tp_btn"><img
                                                                    src="{{ $ASSET_URL }}assets/images/buynow.png"
                                                                    alt="Image" />@lang('master.product_search.buy_now')
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                 </div>
                                                
                                            </a>

                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===Section End===-->
    @endsection
    @section('scripts')
        <script src="{{ asset('user-theme/my_assets/js/product_details.js') }}"></script>
    @endsection
