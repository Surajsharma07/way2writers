    <link href="https://www.way2writers.com/css/bootstrap.css" rel="stylesheet" />

  <div class="row">
		<div class="col-sm-12 social-strip">
			<div class="navbar cus-row">
				<a class="navbar-brand font18 headcall bold"  href="tel:919599889860">
<i class="bi bi-telephone" aria-hidden="true" style="color:#FFFFFF;"></i>
+91 95998 89860
				</a>
				<div class="navbar-nav-scroll">
					<ul class="nav justify-content-end">
						<li class="nav-item">
							<a class="nav-link" href="https://m.youtube.com/channel/UC-zU_pHjAD-4j5VgJsaUAwA" target="_blank" rel="noopener" aria-label="#">
								<i class="bi bi-youtube" aria-hidden="true" style="color:#FFFFFF;"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://www.facebook.com/Way2writerscom-372947246531912/" target="_blank" rel="noopener" aria-label="#">
																<i class="bi bi-facebook" aria-hidden="true" style="color:#FFFFFF;"></i>

							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://www.linkedin.com/company/way2writers321/" target="_blank" rel="noopener" aria-label="#">
																<i class="bi bi-linkedin" aria-hidden="true" style="color:#FFFFFF;"></i>

							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" target="_blank" rel="noopener" aria-label="#">
								<i class="bi bi-twitter" aria-hidden="true" style="color:#FFFFFF;"></i>

							</a>
						</li>
					
					</ul>
				</div>
                </div>
                </div>
                 <div class="container-fluid bg-white wrapper">
		<div class="row slideshow-bg">
			<div class="col-sm-12" style="
    margin: 0;
    padding: 0;
">
			<!--Parent Container Ends -->

              <div class="tp_header_box" style=" background-color: transparent; box-shadow: none; padding: 20px 30px;   font-family: 'Poppins';
   font-size: large;">    <div class="tp_header_logo">
        <a href="{{ route('frontend.home') }}">
            <img src="{{ $STORAGE_URL . @$setting->my_logo }}" alt="logo" />
        </a>
    </div>
    <div class="tp_nav_main">
        <div class="tp_header_menu">
            <ul>
                @if (@$setting->is_check_home)
                    <li @if (Route::is('frontend.home')) class="active" @endif>
                        <a href="{{ route('frontend.home') }}">
                            @lang('master.header.Home')
                        </a>
                    </li>
                @endif

                @if (@$setting->is_check_about)
                    <li @if (Route::is('frontend.about-us')) class="active" @endif><a
                            href="{{ route('frontend.about-us') }}"> @lang('master.header.About_Us')</a>
                    </li>
                @endif

              @if (@$setting->is_check_product)
                    <li @if (Route::is('frontend.product.search')) class="active" @endif>
                            @lang('master.header.Products')
              
                        @php  $featured_category = getFeaturedCategory(); @endphp
                        <ul class="tp_head_dropdown">

                            @if (!empty($featured_category))
                                @foreach (@$featured_category as $row)
                                    <li><a
                                            href="{{ route('frontend.services.single_details', $row->slug) }}">
                                            {{ $row->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endif
               
     @if (@$setting->is_check_terms_and_condition)
                    <li @if (Route::is('frontend.terms-and-conditions')) class="active" @endif>
                        <a href="{{ route('frontend.terms-and-conditions') }}">@lang('master.header.Terms_of_services')</a>
                    </li>
                @endif

                @if (@$setting->is_check_privacy_policy)
                    <li @if (Route::is('frontend.privacy-policy')) class="active" @endif>
                        <a href="{{ route('frontend.privacy-policy') }}">@lang('master.header.Privacy_Policy')</a>
                    </li>
                @endif
                @if (@$setting->is_check_contact)
                    <li @if (Route::is('frontend.contact-us')) class="active" @endif>
                        <a href="{{ route('frontend.contact-us') }}">@lang('master.header.Contact_Us')</a>
                    </li>
                @endif
<li @if (Route::is('frontend.blogs.index')) class="active" @endif>
                        <a href="{{ route('frontend.blogs.index') }}">Blogs</a>
                    </li>
               @if (@$setting->is_check_language)
                    <li>
                        <a href="#">
                            <i class="fa fa-language fa-lg" aria-hidden="true"></i>
                        </a>
                        @php  $lang = getlanguage(); @endphp
                        <ul class="tp_head_dropdown">
                            @if (!empty($lang))
                                @foreach (@$lang as $row)
                                    <li>
                                        <a href="{{ route('frontend.setlang', $row->short_name) }}">
                                            {{ $row->name }} </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <div class="tp_toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="tp_header_login ">
            @if (Auth::check())
             <div class="tp_head_logged" style="
    border: none;
">
                    <div class="tp_head_cart">
                        <a href="{{ route('frontend.cart.index') }}">
                            @if (Cart::instance('default')->count() > 0)
                                <span>{{ Cart::instance('default')->count() }}</span>
                            @endif
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="tp_head_cart">
                        <a href="{{ route('frontend.wishlist') }}">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle d-block text-decoration-none" data-bs-toggle="dropdown"
                            aria-expanded="false" id="dropdownMenuLink" role="button">
                            <img src="@if (!empty(@$auth_user->avatar)) {{ @$auth_user->avatar }} @else {{ @$STORAGE_URL . @$setting->default_user_image }} @endif"
                                alt="{{ @$auth_user->full_name }}" title="{{ @$auth_user->full_name }}" width="32"
                                height="32" class="rounded-circle" />
                        </a>

                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownMenuLink"
                            data-popper-placement="bottom-start">
                            <li>
                                <strong class="dropdown-item" href="#">{{ @$auth_user->full_name }}</strong>
                            </li>
                            @if (@$auth_user->role == 0)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.dashboard') }}">@lang('master.header.Dashboard')</a>
                                </li>
                            @endif
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('frontend.profile') }}">@lang('master.header.Profile')
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.profile', ['tab' => 'my-orders']) }}">@lang('master.header.My_Order')</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('frontend.profile', ['tab' => 'my-downloads']) }}">@lang('master.header.My_Downloads')
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('frontend.logout') }}">@lang('master.header.Sign_out')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <a href="{{ route('frontend.sign-in') }}" class="tp_btn">@lang('master.header.Login')</a>
            @endif
            
        </div>
        
       
    </div>
</div>
