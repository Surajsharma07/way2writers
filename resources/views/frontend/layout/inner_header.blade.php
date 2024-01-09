  <!--===Header Section Start===-->
  <div class="tp_header_navbar">
     
  </div>

  @if (Route::is('frontend.product.search'))
      <div class="tp_banner_section tp_single_section tp_single_search">
          <div class="container">
              <div class="tp_banner_heading">
                  <h2>@lang('master.product_search.title')</h2>
                  <p>
                      @lang('master.product_search.heading')
                  </p>
                  <form action="{{ route('frontend.product.search') }}" method="GET">
                      <div class="tp_search_box">
                          <div class="tp_niceselect_box">
                              <select name="category" class="tp_nice_select">
                                  <option value="">@lang('master.home.choose_category')</option>
                                  @if (!empty($featured_category))
                                      @foreach (@$featured_category as $row)
                                          <option value="{{ $row->slug }}"
                                              @if (request('category') == $row->slug) selected @endif>{{ $row->name }}
                                          </option>
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                          <input type="text" placeholder="@lang('master.home.search_template_here')" id="search_text" name="keyword"
                              value="{{ request('keyword') }}" />
                          <button type="submit" class="tp_btn">@lang('master.home.search')</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  @endif

  <!--===Header Section End===-->
