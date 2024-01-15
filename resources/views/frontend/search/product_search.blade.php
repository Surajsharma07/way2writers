@php
    $ASSET_URL = asset('user-theme') . '/';
    $price_symbol = getSetting()->default_symbol ?? '$';
@endphp
@if ($data->count() > 0)
    @foreach ($data as $key => $items)
        <div class="col-lg-4 col-md-6 tp_single_grid @if($p_view == 1) product_list_view @endif">
            <div class="tp_istop_box">
<a href="{{ route('frontend.product.single_details', $items->slug) }}">
                    <div class="grid_img">
                        <span class="tp-product-list-img tp-animation">
                            <img src="{{ $items->imageUrl }}" class="tp-animation-img" alt="project-img" />
                            @if ($items->is_offer == 2)
                                <div class="tp_sales"><span>Sale</span></div>
                            @endif
                        </span>
                    </div>
           
                    <div class="tp_isbox_content">
                        <div class="bottom_content">
                            <h5>{{ $items->name }}</h5>
                            <p>@lang('master.product_search.by') {{ $items->getUser->full_name }}</p>
                        </div>
                        <div class="tp_wishlist_text">
                            <p>
                                @lang('master.product_search.search_heading')
                            </p>
                        </div>
                        <div class="grid_icon">
                            <div class="star_rating">
                                @include('frontend.include.rating', [
                                    'faRating' => true,
                                    'rating' => @$items->rating,
                                ])
                            </div>
                            <span>{{ $items->sale_count }} sales</span>
                        </div>
                        <div class="addto_cart">
                            @php $productPrice = $items->productPrice(); @endphp
                            <div class="tp_flex_price_st">
                                @if ($productPrice['free'])
                                    <p>
                                        @if (!empty($productPrice['price']))
                                            <del>{{ $price_symbol . @$productPrice['price'] }}</del>
                                        @endif @lang('master.wishlist_product.free')
                                    </p>
                                @elseif($productPrice['price'])
                                    @if (@$productPrice['offer_price'])
                                        <p><del>{{ $price_symbol }}{{ @$productPrice['price'] }}</del></p>
                                        <p>{{ $price_symbol }}{{ @$productPrice['offer_price'] }}</p>
                                    @else
                                        <p>{{ $price_symbol }}{{ @$productPrice['price'] }}</p>
                                    @endif
                                @else
                                    <p>{{ $price_symbol }}{{ @$productPrice['from'] }}</p>
                                    <span>-</span>
                                    <p>{{ $price_symbol }}{{ @$productPrice['to'] }}</p>
                                @endif
                            </div>

                        </div>

                    </div>
                </a>
                <div class="addto_cart addto_cart_btn">
                    <a target="_blank" href="{{ $items->preview_link }}" class="tp_btn tp_cart_btn">Preview Sample</a>
                    <button type="button"
                        @if (Auth::check()) onclick="addtoWishlist('{{ $items->slug }}')" class="active_red tp_btn tp_btn_wish watchlist_btn" @else data-bs-toggle="modal" data-bs-target="#log_modal" class="active_red tp_btn tp_btn_wish" @endif>
                        <i class="fa fa-heart @if (@$items->check_in_wishlist()) active @endif" aria-hidden="true"></i>
                        @lang('master.product_search.add_to_wishlist')</button>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center tp_noproduct">
        <img src="{{ $ASSET_URL }}assets/images/product_not_found.png">
        <p class="text-center">@lang('master.product_search.product_not_found')</p>
    </div>
@endif
