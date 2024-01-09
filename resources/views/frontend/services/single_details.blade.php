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
<title>{{ @$mTitle }}</title>
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

<div>
<div style="height: 300px; background-image: url('{{ $ASSET_URL }}assets/images/my_images/images/product-banner.jpg'); background-position: center;">

    <div style="display: block; padding: 30px; color: #fff; border-radius: 10px; position: relative; width: 100%;">
        <div style="display: flex; flex-wrap: wrap; box-sizing: border-box;">
            <div style="flex: 1 0 100%; max-width: 100%; padding-right: 15px; padding-left: 15px; box-sizing: border-box;">

                <div style="height: 300px; box-sizing: border-box; margin-top: 30px;">
                    <h3 style="line-height: 30px; text-transform: uppercase; margin-bottom: 20px; font-size: 28px; font-weight: 500; font-family: Poppins; color: #fff; margin-top: 0px;">{{ @$product->name }}</h3>
                    <p style="font-size: 16px; font-weight: 600; margin-top: 0px; margin-bottom: 16px; width: 50%; word-wrap: break-word;">{{ @$product->short_desc }}</p>

                        <span style="margin-top: 20px; font-size: 16px; display: block; font-weight: 300;">Get the job you deserve with a powerful, interview-winning resume.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===Single Product Details Section Start===-->
<div class="tp_singlepage_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tp_in2_text">

                </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-12">
                <div class="tp_template_box">
                    <div class="tp_tem_thumb">
                        <div class="tp_preview_icon">
                            <img src="{{ $product->imageUrl }}" alt="Image" />
                            @if (!empty($product->preview_link))
                            <a href="{{ @$product->preview_link }}" class="preview_icon_overlay" target="_blank">
                                <img src="{{ $ASSET_URL }}assets/images/preview-icon.png" alt="Image" /></a>
                            @endif
                        </div>
                    </div>
                    <div class="gallery_nav tp_tem_tab_buttom">
                        
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="tp_tem_description">
                                {!! @$product->description !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="tp_tem_previews">
                                <h3> @lang('master.single_product.previews_nd_screenshots')</h3>
                                @if (!empty($product_meta->preview_imgs))
                                @php $preview_imgs_arr = (object) unserialize(@$product_meta->preview_imgs); @endphp
                                @foreach ($preview_imgs_arr as $key => $value)
                                <img src="{{ getImage($value) }}" alt="Preview Image" loading="lazy" />
                                @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="tp_tem_comments tp_tem_reviews">
                                <div class="tp_filter_box">
                                    <div class="tp_fil_text">
                                        <h3>
                                            <img src="{{ $ASSET_URL }}assets/images/three_star.png" alt="Image" />
                                            {{ @$product->getProductReview->count() }} Reviews for this product
                                        </h3>
                                    </div>
                                    <div class="tp_fil_range">
                                        <ul>
                                            <li>@lang('master.single_product.filter_by_rating')</li>
                                            <li>
                                                <div class="tp_select_box">
                                                    <select class="wide tp_nice_select" id="filter_rating"
                                                        onchange="search_rating()">
                                                        <option value="">Star</option>
                                                        @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}
                                                            Star</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tp_comments_box" id="review_search_box">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Comments" role="tabpanel"
                            aria-labelledby="pills-Comments-tab">
                            <div class="tp_tem_comments">
                                <div class="tp_comm_box">
                                    <form method="POST" id="add-product-comment-form">
                                        @csrf
                                        <div class="form-outline form-white">
                                            <label class="form-label fw-semibold"
                                                for="comment">@lang('master.single_product.add_comment')</label>
                                            <textarea name="comment" rows="3" cols="30"
                                                class="form-control come comment-text-area"
                                                placeholder="Add a comment here..." @if (!Auth::check()) disabled
                                                @endif></textarea>
                                            <button class="tp_btn tp_btn_post" @if (!Auth::check())
                                                data-bs-toggle="modal" data-bs-target="#log_modal" type="button" @else
                                                type="submit" @endif
                                                id="add-product-comment-form-btn">@lang('master.single_product.post_comment')</button>
                                        </div>
                                        <input type="hidden" name="product_id" id="product_id"
                                            value="{{ @$product->id }}">
                                    </form>
                                </div>
                                <div class="tp_filter_box">
                                    <div class="tp_fil_text">
                                        <h3>
                                            <img src="{{ $ASSET_URL }}assets/images/comment_icon.png" alt="Image" />
                                            {{ @$product->getProductComment->count() }}
                                            @lang('master.single_product.comments_found')
                                        </h3>
                                    </div>
                                    <div class="tp_fil_range">
                                        <ul>
                                            <li>Filter By</li>
                                            <li>
                                                <div class="tp_select_box">
                                                    <select onchange="search_comment()" id="filter_month"
                                                        class="tp_nice_select">
                                                        <option value=""> Month
                                                        </option>
                                                        @for ($m = 1; $m <= 12; $m++) @php $month=date('M',
                                                            mktime(0,0,0,$m, 1, date('Y'))); @endphp <option
                                                            value="{{ $m }}">
                                                            {{ $month }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="tp_select_box">
                                                    <select onchange="search_comment()" id="filter_year"
                                                        class="wide tp_nice_select">
                                                        <option value="" selected> Year
                                                        </option>
                                                        <option value="{{ date('Y') }}">{{ date('Y') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tp_comments_box" id="cmd_search_box">
                                </div>
                                <div class="text-center mt-2">
                                    <button type="button" class="tp_btn border rounded-pill d-none"
                                        id="load_more_cmd_button"
                                        data="2">@lang('master.product_search.Loadmore')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tp_add_image" id="advertize-ad"></div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-12">
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
                                                    <h2><span></span>{{ $price_symbol . @$product->price }}</h2>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endif
 
                                @if ($product->category_id != 2)
    <div><br>
        <input type="checkbox" value="1" name="include_cover_letter">
        <label>Include Cover Letter ({{ $price_symbol }}350)</label>
    </div>
@endif

                                
<div class="tp_product_detailhead">
<h4>Select Delivery Option</h4>
</div>
@foreach($deliveryoptions as $option)
<div>
<input type="radio" value="{{ $option->id }}" name="delivery_option" @if ($option->id === 1) checked @endif>
<label>{{ $option->name }} - {{ $price_symbol . $option->amount }}</label>
@endforeach  
</div>
</div> 
    </div>
</div>
</div>
<div class="tp_product_detailhead">
                    </div>
                   <div class="tp_leftbar_box">
                        <div class="tp_tem_option">
                            <div class="grid_icon">
                               
                            <div class="tp_buy_btn">
                                <a href="javascript:;" @if (Auth::check()) onclick="addToCart('',1)" @else
                                    data-bs-toggle="modal" data-bs-target="#log_modal" @endif class="tp_btn"><img
                                        src="{{ $ASSET_URL }}assets/images/buynow.png"
                                        alt="Image" />@lang('master.product_search.buy_now')
                                </a>

                                <button type="button" onclick="addToCart()" class="tp_btn"><img
                                        src="{{ $ASSET_URL }}assets/images/addtocart.png" alt="Image" />
                                    @lang('master.single_product.add_to_cart')
                                </button>
                                @if (isset($product->preview_link) && !empty($product->preview_link))
                                <a target="_blank" href="{{ $product->preview_link }}" class="tp_btn"><img
                                        src="{{ $ASSET_URL }}assets/images/live_preview.png"
                                        alt="Image" />@lang('master.product_search.live_preview')</a>
                                @endif

                                <input type="hidden" name="slug" value="{{ $product->slug }}">

                                <button type="button" @if (Auth::check())
                                    onclick="addtoWishlist('{{ $product->slug }}')"
                                    class="active_red tp_btn tp_btn_wish watchlist_btn" @else data-bs-toggle="modal"
                                    data-bs-target="#log_modal" class="active_red tp_btn tp_btn_wish" @endif><i
                                        class="fa fa-heart @if (@$product->check_in_wishlist()) active @endif"
                                        aria-hidden="true"></i>@lang('master.single_product.add_to_wishlist')</button>
                            </div>
                        </div>
                    </div>
                </form>

<!--===product details===-->

                <div class="tp_leftbar_box">
                    <div class="tp_product_detailhead">
                        <h4>@lang('master.single_product.product_details')</h4>
                    </div>
                    <div class="tp_product_detail">
                        @if (@$product->product_details[0])
                        <ul>
                            @foreach (@$product->product_details as $key => $val)
                            <li>{{ @$val['key'] }}<span>{{ @$val['value'] }}</span></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
               
                                    
            </div>
        </div>
    </div>
</div>
<!--===Categories Section Start===-->
<div class="tp_istop_gallery">
    <div class="container">
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
                                <a
href="{{ route('frontend.services.single_details', $items->slug) }}">
                                    <div class="tp_istop_box tp-animation-box">
                                        <div class="grid_img">
                                            <span class="tp-product-list-img tp-animation">
                                                <img src="{{ $items->thumb }}" class="tp-animation-img"
                                                    alt="project-img" />
                                            </span>
                                        </div>
                                        <div class="tp_isbox_content">
                                            <div class="bottom_content">
                                                <h5>{{ $items->name }}</h5>
                                                <p>also includes</p>
                                            </div>
                                            <div class="tp_product_detail">
                                                @if (@$items->product_details[0])
                                                <ul>
                                                    @foreach (@$items->product_details as $key => $val)
                                                    <li
                                                        style="background:rgb(241, 241, 241) none repeat scroll 0% 0% / auto padding-box border-box;padding:10px 0px;text-align:center;list-style:outside none none;color:rgb(34, 34, 34);box-sizing:border-box;">
                                                        <i aria-hidden="true"
                                                            style="display:inline-block;font-style:normal;font-variant:normal;font-kerning: auto;font-optical-sizing: auto;font-feature-settings:normal;font-variation-settings:normal;font-weight:400;font-stretch:100%;line-height:14px;font-family:FontAwesome;font-size:14px;text-rendering: auto;-webkit-font-smoothing:antialiased;box-sizing:border-box;"></i>{{
                                                        @$val['key'] }}<span>{{ @$val['value'] }}</span></li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                           

                                            <div class="addto_cart tp_live_home">

                                                @php $productPrice = $items->productPrice(); @endphp
                                                <div class="tp_flex_price_st">
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
                                                </div>
                                                
                                                <a href="javascript:;" @if (Auth::check()) onclick="addToCart('',1)"
                                                    @else data-bs-toggle="modal" data-bs-target="#log_modal" @endif
                                                    class="tp_btn"><img src="{{ $ASSET_URL }}assets/images/buynow.png"
                                                        alt="Image" />@lang('master.product_search.buy_now')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="tp-pro-icon">
                                    <button type="button" @if (Auth::check())
                                        onclick="addtoWishlist('{{ $items->slug }}')" class="watchlist_btn" @else
                                        data-bs-toggle="modal" data-bs-target="#log_modal" @endif><i
                                            class="fa fa-heart @if (@$items->check_in_wishlist()) active @endif"
                                            aria-hidden="true"></i>
                                    </button>
                                </div>
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